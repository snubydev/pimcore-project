<?php

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Commercial License (PCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PCL
 */

namespace Pimcore\Model\Document\Service;

use Pimcore\Db\Helper;
use Pimcore\Model;
use Pimcore\Model\Document;
use Pimcore\Model\Site;

/**
 * @internal
 *
 * @property \Pimcore\Model\Document\Service $model
 */
class Dao extends Model\Dao\AbstractDao
{
    /**
     * @param Site $site
     * @param string $path
     *
     * @return int
     */
    public function getDocumentIdByPrettyUrlInSite(Site $site, $path)
    {
        return (int) $this->db->fetchOne(
            'SELECT documents.id FROM documents
            LEFT JOIN documents_page ON documents.id = documents_page.id
            WHERE documents.path LIKE ? AND documents_page.prettyUrl = ?',
            [Helper::escapeLike($site->getRootPath()) . '/%', rtrim($path, '/')]
        );
    }

    /**
     * @param Document $document
     *
     * @return int
     */
    public function getTranslationSourceId(Document $document)
    {
        $sourceId = $this->db->fetchOne('SELECT sourceId FROM documents_translations WHERE id = ?', [$document->getId()]);
        if (!$sourceId) {
            $sourceId = $document->getId();
        }

        return $sourceId;
    }

    /**
     * @param Document $document
     * @param string $task
     *
     * @return int[]
     */
    public function getTranslations(Document $document, $task = 'open')
    {
        $sourceId = $this->getTranslationSourceId($document);
        $data = $this->db->fetchAllAssociative('SELECT id,language FROM documents_translations WHERE sourceId IN(?, ?) UNION SELECT sourceId as id,"source" FROM documents_translations WHERE id = ?', [$sourceId, $document->getId(), $document->getId()]);

        if ($task == 'open') {
            $linkedData = [];
            foreach ($data as $value) {
                $linkedData = $this->db->fetchAllAssociative('SELECT id,language FROM documents_translations WHERE sourceId = ? UNION SELECT sourceId as id,"source" FROM documents_translations WHERE id = ?', [$value['id'], $value['id']]);
            }

            if (count($linkedData) > 0) {
                $data = array_merge($data, $linkedData);
            }
        }

        $translations = [];
        foreach ($data as $translation) {
            if ($translation['language'] == 'source') {
                $sourceDocument = Document::getById((int) $translation['id']);
                $translations[$sourceDocument->getProperty('language')] = $sourceDocument->getId();
            } else {
                $translations[$translation['language']] = (int) $translation['id'];
            }
        }

        // add language from source document
        if (!empty($translations)) {
            $sourceDocument = Document::getById($sourceId);
            $translations[$sourceDocument->getProperty('language')] = $sourceDocument->getId();
        }

        return $translations;
    }

    /**
     * @param Document $document
     * @param Document $translation
     * @param string|null $language
     */
    public function addTranslation(Document $document, Document $translation, $language = null)
    {
        $sourceId = $this->getTranslationSourceId($document);

        if (!$language) {
            $language = $translation->getProperty('language');
        }

        Helper::insertOrUpdate($this->db, 'documents_translations', [
            'id' => $translation->getId(),
            'sourceId' => $sourceId,
            'language' => $language,
        ]);
    }

    /**
     * @param Document $document
     */
    public function removeTranslation(Document $document)
    {
        // if $document is a source-document, we need to move them over to a new document
        $newSourceId = $this->db->fetchOne('SELECT id FROM documents_translations WHERE sourceId = ?', [$document->getId()]);
        if ($newSourceId) {
            $this->db->update('documents_translations', ['sourceId' => $newSourceId], ['sourceId' => $document->getId()]);
            $this->db->delete('documents_translations', ['id' => $newSourceId]);
        }
    }

    /**
     * @param Document $document
     * @param Document $targetDocument
     */
    public function removeTranslationLink(Document $document, Document $targetDocument)
    {
        $sourceId = $this->getTranslationSourceId($document);

        if ($targetDocument->getId() == $sourceId) {
            $sourceId = $document->getId();
        }

        $newSourceId = $this->db->fetchOne('SELECT id FROM documents_translations WHERE id = ? AND sourceId = ?', [$targetDocument->getId(), $sourceId]);

        if (empty($newSourceId)) {
            $sourceId = $document->getId();
        }

        // Remove in both way
        $this->db->delete('documents_translations', ['id' => $targetDocument->getId(), 'sourceId' => $sourceId]);
        $this->db->delete('documents_translations', ['id' => $sourceId, 'sourceId' => $targetDocument->getId()]);
    }
}
