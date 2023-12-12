<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use CodeIgniter\I18n\Calendar;

class Dashboard extends Controller
{
    public function index()
    {
        // Set waktu dan zona waktu dari hari ini
        $now = new Time('now', 'Asia/Jakarta');

        // Buat instance dari Calendaring Class
        $cal = new Calendar();

        // Generate kalender dengan Calendaring Class
        $calendar = $cal->generate($now->getYear(), $now->getMonth());

        // Load tampilan dashboard dan kirimkan data kalender ke dalamnya
        return view('dashboard', ['calendar' => $calendar]);
    }
}
