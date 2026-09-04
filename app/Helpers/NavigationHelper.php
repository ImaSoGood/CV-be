<?php

namespace App\Helpers;

use App\Models\Content;
use App\Models\General;
use App\Models\Page;

class NavigationHelper 
{
    public static function getPagesWithContent()
    {
        $pages = Page::where('visibility', true)
            ->with('content')
        ->get();
        dd($pages[0]->data);
    }

    public function getPage(string $slug): ?array
    {
        $page = Page::where('meta_data->slug', $slug)
            ->where('visibility', true)
            ->first();

        if (!$page) {
            return null;
        }

        $pageData = json_decode($page->data, true);
        $metaData = json_decode($page->meta_data, true);
        $content = Content::where('page_id', $page->id)
            ->orderBy('position')
            ->get()
            ->map(function ($item) {
                return [
                    'type' => json_decode($item->meta_data, true)['type'] ?? 'text',
                    'header' => $item->header,
                    'additional' => $item->aditional,
                    'text' => $item->text,
                    'meta_data' => json_decode($item->meta_data, true),
                ];
            })
            ->toArray();

        return [
            'page' => [
                'id' => $page->id,
                'slug' => $metaData['slug'] ?? '',
                'title' => $metaData['title'] ?? '',
                'description' => $metaData['description'] ?? '',
                'template' => $pageData['template'] ?? 'default',
                'layout' => $pageData['layout'] ?? 'default',
            ],
            'content' => $content,
        ];
    }

    public function getMenu(): array
    {
        $general = General::first();
        if (!$general) {
            return [];
        }

        $sections = json_decode($general->sections, true);
        return $sections['header']['menu'] ?? [];
    }

    public function getPageContent(string $slug): array
    {
        $data = $this->getPage($slug);
        if (!$data) {
            return ['blocks' => []];
        }

        $blocks = [];
        foreach ($data['content'] as $block) {
            switch ($block['type']) {
                case 'hero':
                    $blocks[] = $this->parseHeroBlock($block);
                    break;
                case 'grid':
                    $blocks[] = $this->parseGridBlock($block);
                    break;
                case 'timeline':
                    $blocks[] = $this->parseTimelineBlock($block);
                    break;
                case 'goals':
                    $blocks[] = $this->parseGoalsBlock($block);
                    break;
                case 'contacts':
                    $blocks[] = $this->parseContactsBlock($block);
                    break;
                default:
                    $blocks[] = $this->parseTextBlock($block);
            }
        }

        return [
            'page' => $data['page'],
            'blocks' => $blocks,
        ];
    }

    private function parseHeroBlock(array $block): array
    {
        return [
            'component' => 'HeroSection',
            'props' => [
                'title' => $block['header'],
                'subtitle' => $block['additional'],
                'content' => $block['text'],
                'size' => $block['meta_data']['size'] ?? 'medium',
                'alignment' => $block['meta_data']['alignment'] ?? 'left',
            ],
        ];
    }

    private function parseGridBlock(array $block): array
    {
        return [
            'component' => 'GridSection',
            'props' => [
                'title' => $block['header'],
                'subtitle' => $block['additional'],
                'columns' => $block['meta_data']['columns'] ?? 3,
                'items' => $block['meta_data']['items'] ?? [],
            ],
        ];
    }

    private function parseTimelineBlock(array $block): array
    {
        return [
            'component' => 'TimelineSection',
            'props' => [
                'title' => $block['header'],
                'subtitle' => $block['additional'],
                'items' => $block['meta_data']['items'] ?? [],
            ],
        ];
    }

    private function parseGoalsBlock(array $block): array
    {
        return [
            'component' => 'GoalsSection',
            'props' => [
                'title' => $block['header'],
                'subtitle' => $block['additional'],
                'items' => $block['meta_data']['items'] ?? [],
            ],
        ];
    }

    private function parseContactsBlock(array $block): array
    {
        return [
            'component' => 'ContactsSection',
            'props' => [
                'title' => $block['header'],
                'subtitle' => $block['additional'],
                'text' => $block['text'],
                'social_networks' => $block['meta_data']['social_networks'] ?? [],
            ],
        ];
    }

    private function parseTextBlock(array $block): array
    {
        return [
            'component' => 'TextSection',
            'props' => [
                'title' => $block['header'],
                'subtitle' => $block['additional'],
                'content' => $block['text'],
            ],
        ];
    }

    public function getAllVisiblePages(): array
    {
        return Page::where('visibility', true)
            ->select('id', 'meta_data', 'data')
            ->get()
            ->map(function ($page) {
                $metaData = json_decode($page->meta_data, true);
                return [
                    'id' => $page->id,
                    'title' => $metaData['title'] ?? '',
                    'slug' => $metaData['slug'] ?? '',
                ];
            })
        ->toArray();
    }
}