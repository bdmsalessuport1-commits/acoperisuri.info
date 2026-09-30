<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Helpers\DataStore;

class EventController
{
    private DataStore $store;

    public function __construct()
    {
        $this->store = new DataStore('events');
    }

    public function index(array $params, array $route): void
    {
        $events = $this->getPublishedEvents();
        usort($events, fn($a, $b) => strtotime($b['date'] ?? '') - strtotime($a['date'] ?? ''));

        View::render('pages/events', [
            'pageTitle' => 'Evenimente - BDM Systems',
            'pageDescription' => 'Evenimentele la care participam si organizam in domeniul constructiilor si acoperisurilor.',
            'events' => $events,
            'breadcrumbs' => [['label' => 'Evenimente']],
        ]);
    }

    public function show(array $params, array $route): void
    {
        $slug = $params['slug'] ?? '';
        $events = $this->getPublishedEvents();

        $event = null;
        foreach ($events as $e) {
            if ($e['slug'] === $slug) {
                $event = $e;
                break;
            }
        }

        if (!$event) {
            View::render404();
            return;
        }

        $related = array_values(array_filter($events, fn($e) => $e['slug'] !== $slug));
        $related = array_slice($related, 0, 3);

        View::render('pages/event-single', [
            'pageTitle' => $event['title'] . ' | Evenimente BDM Systems',
            'pageDescription' => mb_substr(strip_tags($event['description'] ?? ''), 0, 160),
            'pageType' => 'article',
            'pageImage' => $event['image_featured'] ?? null,
            'event' => $event,
            'relatedEvents' => $related,
            'breadcrumbs' => [
                ['label' => 'Evenimente', 'url' => '/evenimente'],
                ['label' => $event['title']],
            ],
        ]);
    }

    private function getPublishedEvents(): array
    {
        $events = [];
        foreach ($this->store->all() as $e) {
            if (($e['status'] ?? 'draft') === 'publicat') {
                $e['date_display'] = $this->formatDateRo($e['date'] ?? '');
                $events[] = $e;
            }
        }
        return $events;
    }

    private function formatDateRo(string $date): string
    {
        $months = [1=>'ianuarie',2=>'februarie',3=>'martie',4=>'aprilie',5=>'mai',6=>'iunie',
            7=>'iulie',8=>'august',9=>'septembrie',10=>'octombrie',11=>'noiembrie',12=>'decembrie'];
        $ts = strtotime($date);
        if (!$ts) return $date;
        return date('j', $ts) . ' ' . ($months[(int)date('n', $ts)] ?? '') . ' ' . date('Y', $ts);
    }
}
