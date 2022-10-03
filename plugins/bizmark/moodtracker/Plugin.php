<?php namespace Bizmark\Moodtracker;

use Backend;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Moodtracker',
            'description' => 'No description provided yet...',
            'author'      => 'Bizmark',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Bizmark\Moodtracker\Components\Mood' => 'Mood',
        ];
    }

    /**
     * Registers any backend permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'bizmark.moodtracker.some_permission' => [
                'tab' => 'Moodtracker',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers backend navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'mooditem' => [
                'label'       => 'Moodtracker',
                'url'         => Backend::url('bizmark/moodtracker/MoodItems'),
                'icon'        => 'icon-leaf',
                'permissions' => ['bizmark.moodtracker.*'],
                'order'       => 500,
            ],
        ];
    }
}
