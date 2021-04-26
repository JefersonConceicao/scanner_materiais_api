<div class="row">
    {{-- filtro --}}
    <div class="col-md-12">
        <div class="box" id="boxFiltroUser">
            <div class="box-header with-border">
                <div class="box-title">  
                    <i class="fa fa-filter"> </i>
                     Filtro 
                </div>

                <div class="box-tools pull-right">
                    <button data-widget="collapse" class="btn btn-box-tool"> 
                        <i class="fa fa-minus"> </i>     
                    </button>   
                </div>
            </div>
            <div class="box-body"> 
                {{  $slot }}
            </div>
        </div>
    </div>
    {{-- fim filtro --}}
</div>