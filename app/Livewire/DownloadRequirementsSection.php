<?php

namespace App\Livewire;

use App\Models\DownloadLog;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Throwable;

class DownloadRequirementsSection extends Component
{
    public string $downloadWindows;
    public string $downloadLinux;
    public string $itchUrl;
    public string $githubUrl;
    public string $version;
    public array $requirements = [];

    public function mount(): void
    {
        $this->downloadWindows = config('sertao.links.download_windows');
        $this->downloadLinux = config('sertao.links.download_linux');
        $this->itchUrl = config('sertao.links.itch');
        $this->githubUrl = config('sertao.links.github');
        $this->version = config('sertao.version');
        $this->requirements = config('sertao.requirements', []);
    }

    public function trackDownload(string $platform): void
    {
        try {
            if (Schema::hasTable('download_logs')) {
                DownloadLog::create([
                    'platform' => $platform,
                    'version' => $this->version,
                    'ip_address' => request()->ip(),
                    'user_agent' => substr((string) request()->userAgent(), 0, 500),
                ]);
            }
        } catch (Throwable) {
            // Ignore logging error if database is unavailable
        }
    }

    public function render()
    {
        return view('livewire.download-requirements-section');
    }
}
