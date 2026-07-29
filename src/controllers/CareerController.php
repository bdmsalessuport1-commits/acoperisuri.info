<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Helpers\DataStore;

class CareerController
{
    private DataStore $store;

    public function __construct()
    {
        $this->store = new DataStore('jobs');
    }

    public function index(array $params, array $route): void
    {
        $jobs = [];
        foreach ($this->store->orderBy('sort_order') as $job) {
            if (($job['status'] ?? 'inactiv') === 'activ') {
                $jobs[] = $job;
            }
        }

        View::render('pages/careers', [
            'pageTitle' => 'Cariere - Lucreaza la BDM Systems',
            'pageDescription' => 'Joburi disponibile la BDM Systems. Alatura-te echipei noastre de profesionisti in domeniul acoperisurilor.',
            'jobs' => $jobs,
            'breadcrumbs' => [['label' => 'Cariere']],
        ]);
    }

    public function show(array $params, array $route): void
    {
        $slug = $params['slug'] ?? '';
        $job = null;
        foreach ($this->store->all() as $j) {
            if ($j['slug'] === $slug && ($j['status'] ?? 'inactiv') === 'activ') {
                $job = $j;
                break;
            }
        }

        if (!$job) {
            View::render404();
            return;
        }

        $otherJobs = [];
        foreach ($this->store->orderBy('sort_order') as $j) {
            if (($j['status'] ?? 'inactiv') === 'activ' && $j['slug'] !== $slug) {
                $otherJobs[] = $j;
            }
        }

        View::render('pages/career-single', [
            'pageTitle' => $job['title'] . ' - Cariere BDM Systems',
            'pageDescription' => mb_substr($job['description'] ?? '', 0, 160),
            'job' => $job,
            'otherJobs' => $otherJobs,
            'breadcrumbs' => [
                ['label' => 'Cariere', 'url' => '/cariere'],
                ['label' => $job['title']],
            ],
        ]);
    }
}
