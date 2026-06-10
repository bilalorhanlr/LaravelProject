<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    private const TABS = ['general', 'smtp', 'social', 'about', 'contact', 'references'];

    public function index(Request $request): View
    {
        $tab = in_array($request->query('tab'), self::TABS, true)
            ? $request->query('tab')
            : 'general';

        return view('admin.settings.index', [
            'setting' => $this->setting(),
            'tab' => $tab,
            'tabs' => self::TABS,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $tab = $request->input('tab', 'general');
        $setting = $this->setting();

        $validated = $request->validate(match ($tab) {
            'general' => [
                'title' => ['required', 'string', 'max:255'],
                'keywords' => ['nullable', 'string', 'max:255'],
                'description' => ['nullable', 'string'],
                'company' => ['nullable', 'string', 'max:255'],
                'address' => ['nullable', 'string'],
                'phone' => ['nullable', 'string', 'max:50'],
                'fax' => ['nullable', 'string', 'max:50'],
                'email' => ['nullable', 'email', 'max:255'],
                'status' => ['required', 'in:active,inactive'],
            ],
            'smtp' => [
                'smtpserver' => ['nullable', 'string', 'max:255'],
                'smtpemail' => ['nullable', 'email', 'max:255'],
                'smtppassword' => ['nullable', 'string', 'max:255'],
                'smtpport' => ['nullable', 'string', 'max:10'],
            ],
            'social' => [
                'facebook' => ['nullable', 'string', 'max:255'],
                'instagram' => ['nullable', 'string', 'max:255'],
                'twitter' => ['nullable', 'string', 'max:255'],
            ],
            'about' => [
                'aboutus' => ['nullable', 'string'],
            ],
            'contact' => [
                'contact' => ['nullable', 'string'],
            ],
            'references' => [
                'references' => ['nullable', 'string'],
            ],
            default => [],
        });

        $setting->update($validated);

        return redirect()
            ->route('admin.settings.index', ['tab' => $tab])
            ->with('success', 'Settings updated successfully.');
    }

    private function setting(): Setting
    {
        return Setting::firstOrCreate(
            ['id' => 1],
            [
                'title' => 'Best buy E-Commerce',
                'email' => 'info@e-shop.com',
                'status' => 'active',
            ]
        );
    }
}
