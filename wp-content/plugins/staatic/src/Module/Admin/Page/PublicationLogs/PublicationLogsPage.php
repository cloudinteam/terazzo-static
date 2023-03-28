<?php

declare(strict_types=1);

namespace Staatic\WordPress\Module\Admin\Page\PublicationLogs;

use Staatic\WordPress\Module\Admin\Page\Publications\PublicationsPage;
use Staatic\WordPress\Module\ModuleInterface;
use Staatic\WordPress\Publication\Publication;
use Staatic\WordPress\Publication\PublicationRepository;
use Staatic\WordPress\Service\AdminNavigation;
use Staatic\WordPress\Service\PartialRenderer;

final class PublicationLogsPage implements ModuleInterface
{
    /** @var string */
    const PAGE_SLUG = 'staatic-publication-logs';

    /**
     * @var Publication|null
     */
    private $publication;

    /**
     * @var AdminNavigation
     */
    private $navigation;

    /**
     * @var PartialRenderer
     */
    private $renderer;

    /**
     * @var PublicationRepository
     */
    private $publicationRepository;

    /**
     * @var PublicationLogsTable
     */
    private $listTable;

    public function __construct(
        AdminNavigation $navigation,
        PartialRenderer $renderer,
        PublicationRepository $publicationRepository,
        PublicationLogsTable $listTable
    )
    {
        $this->navigation = $navigation;
        $this->renderer = $renderer;
        $this->publicationRepository = $publicationRepository;
        $this->listTable = $listTable;
    }

    /**
     * @return void
     */
    public function hooks()
    {
        if (!\is_admin()) {
            return;
        }
        \add_action('init', [$this, 'addPage']);
        $this->listTable->registerHooks(\sprintf('staatic_page_%s', self::PAGE_SLUG));
    }

    /**
     * @return void
     */
    public function addPage()
    {
        $this->navigation->addPage(
            \__('Publication Logs', 'staatic'),
            self::PAGE_SLUG,
            [$this, 'render'],
            'edit_posts',
            PublicationsPage::PAGE_SLUG,
            [$this, 'load']
        );
    }

    /**
     * @return void
     */
    public function load()
    {
        $publicationId = isset($_REQUEST['id']) ? \sanitize_key($_REQUEST['id']) : null;
        if (!$publicationId) {
            \wp_die(\__('Missing publication id.', 'staatic'));
        }
        if (!($this->publication = $this->publicationRepository->find($publicationId))) {
            \wp_die(\__('Invalid publication.', 'staatic'));
        }
        $this->listTable->initialize(
            \admin_url(\sprintf('admin.php?page=%s&id=%s', self::PAGE_SLUG, $this->publication->id())),
            [
            'publicationId' => $this->publication->id()
        ]
        );
    }

    /**
     * @return void
     */
    public function render()
    {
        $listTable = $this->listTable->wpListTable();
        $listTable->prepare_items();
        $this->renderer->render('admin/publication/logs.php', [
            'listTable' => $listTable,
            'publication' => $this->publication
        ]);
    }
}