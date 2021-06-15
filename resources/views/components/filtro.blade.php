<div class="row">
    <div class="col-md-12">
        <div class="box" id="boxFiltroUser">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box-title">  
                            <i class="fa fa-filter"> </i>
                            Filtro 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button 
                            id="activeFilter"
                            data-toggle="collapse"
                            data-target="#contentFilter"
                            aria-expanded="false"
                            aria-controls="collapseExample"
                            type="button"
                            class="btn btn-primary pull-right"
                        > 
                            <i class="fa fa-angle-down"> </i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="box-body collapse" id="contentFilter"> 
                {{  $slot }}
            </div>
        </div>
    </div>
</div>