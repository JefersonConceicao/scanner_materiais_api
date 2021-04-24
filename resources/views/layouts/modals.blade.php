@extends('adminlte::page')
    @section('modal')
        @hasSection('form_modal')
            <form id="@yield('form_modal')">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"> 
                        &times 
                    </button>
                    <h4 class="modal-title"> 
                        @yield('modal-header')
                    </h4>
                </div>
                <div class="modal-body">
                    @yield('modal_content')
                </div>
                <div class="modal-footer">
                    @hasSection('btn_fechar')
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"> 
                            @yield('btn_fechar')
                        </button>
                    @endif
                    @hasSection('btn_submit')
                        <button type="submit" class="btn btn-primary pull-right"> 
                            @yield('btn_submit')
                        </button>
                    @endif
                <div>
            </form>
        @else
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"> 
                    &times 
                </button>
                <h4 class="modal-title"> 
                    @yield('modal-header')
                </h4>
            </div>
            <div class="modal-body">
                @yield('modal_content')
            </div>
            <div class="modal-footer">
                @hasSection('btn_fechar')
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"> 
                        @yield('btn_fechar')
                    </button>
                @endif
                @hasSection('btn_submit')
                    <button type="submit" class="btn btn-primary pull-right"> 
                        @yield('btn_submit')
                    </button>
                @endif
            </div>
        @endif
    @endsection