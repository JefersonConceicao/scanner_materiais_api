<?php

namespace App\Observers;

use App\Models\Funcionalidade;

class FuncionalidadeObserver
{
    /**
     * Handle the funcionalidade "created" event.
     *
     * @param  \App\Models\Funcionalidade  $funcionalidade
     * @return void
     */
    public function created(Funcionalidade $funcionalidade)
    {
        
    }

    /**
     * Handle the funcionalidade "updated" event.
     *
     * @param  \App\Models\Funcionalidade  $funcionalidade
     * @return void
     */
    public function updated(Funcionalidade $funcionalidade)
    {
        //
    }

    /**
     * Handle the funcionalidade "deleted" event.
     *
     * @param  \App\Models\Funcionalidade  $funcionalidade
     * @return void
     */
    public function deleted(Funcionalidade $funcionalidade)
    {
        //
    }

    /**
     * Handle the funcionalidade "restored" event.
     *
     * @param  \App\Funcionalidade  $funcionalidade
     * @return void
     */
    public function restored(Funcionalidade $funcionalidade)
    {
        //
    }

    /**
     * Handle the funcionalidade "force deleted" event.
     *
     * @param  \App\Funcionalidade  $funcionalidade
     * @return void
     */
    public function forceDeleted(Funcionalidade $funcionalidade)
    {
        //
    }
}
