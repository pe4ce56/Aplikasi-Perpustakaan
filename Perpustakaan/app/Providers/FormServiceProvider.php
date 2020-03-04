<?php

namespace App\Providers;

use Form;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('bsText', 'components.form.text', ['name', 'value' => null, 'id', 'attributes' => ['id']]);
        Form::component('bsTextarea', 'components.form.textarea', ['name', 'value' => null, 'attributes' => []]);
        Form::component('bsOption', 'components.form.option', ['name', 'option' => [], 'selected' => null, 'attributes' => []]);
        Form::component('bsFile', 'components.form.file', ['name', 'method' => null, 'attributes' => []]);
        Form::component('bsDate', 'components.form.date', ['name', 'value' => null, 'attributes' => []]);
    }
}
