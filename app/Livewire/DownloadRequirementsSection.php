<?php

namespace App\Livewire;

use App\Models\DownloadLog;
use App\Models\SiteSetting;
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
        $settings = SiteSetting::values();
        $this->downloadWindows = $settings['download_windows'];
        $this->downloadLinux = $settings['download_linux'];
        $this->itchUrl = $settings['itch'];
        $this->githubUrl = $settings['github'];
        $this->version = $settings['version'];
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
