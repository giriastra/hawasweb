<style type="text/css">


body.vertical-layout[data-color=bg-chartbg] .navbar-container, body.vertical-layout[data-color=bg-chartbg] .content-wrapper-before {
    /*background-color: #000 !important;*/
    /*background-image: url('<?=base_url()?>assets/img/vector.png');*/
    background-image: linear-gradient(to right, #9f78ff, #32cafe);    
}

.content-wrapper-before {

    height: 120px !important;

}

.container {
  max-width: 960px;
}


/* */

.panel-default>.panel-heading {
  color: #333;
  background-color: #fff;
  border-color: #e4e5e7;
  padding: 0;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.panel-default>.panel-heading a {
  display: block;
  padding: 10px 15px;
}

.panel-default>.panel-heading a:after {
  content: "";
  position: relative;
  top: 1px;
  display: inline-block;
  font-family: 'Glyphicons Halflings';
  font-style: normal;
  font-weight: 400;
  line-height: 1;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  float: right;
  transition: transform .25s linear;
  -webkit-transition: -webkit-transform .25s linear;
}

.panel-default>.panel-heading a[aria-expanded="true"] {
  background-color: #eee;
}

.panel-default>.panel-heading a[aria-expanded="true"]:after {
  content: "\2212";
  -webkit-transform: rotate(180deg);
  transform: rotate(180deg);
}

.panel-default>.panel-heading a[aria-expanded="false"]:after {
  content: "\002b";
  -webkit-transform: rotate(90deg);
  transform: rotate(90deg);
}

.panel-default>.panel-heading a {
    display: block;
    padding: 10px 15px;
    color: #fff;
    font-weight: bold;
    background: #709bfe !important;
    border-radius: 5px;
}

.main-menu2 {
    position: relative !important;
    z-index: 1051;
    display: table-cell;
}

.main-menu2.menu-shadow {
    -webkit-box-shadow: 1px 0 30px rgba(0, 0, 0, .1);
    box-shadow: 1px 0 30px rgba(0, 0, 0, .1);
}

.main-menu2.menu-light {
    color: #2b345f;
    border-right: 1px solid #e4e7ed;
    background: #fff;
}

.clicked {
    background: #2196f3;
    color: #fff;
    font-weight: 600 !important;
  }
.panel-default>.panel-heading a {
    display: block;
    padding: 10px 15px;
    color: #fff;
    font-weight: bold;
    background-image: linear-gradient(to right, #0088f5, #32cafe) !important;
    border-radius: 5px;
}


</style>

 
        <div class="content-header row" style="margin-top: ;">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Bantuan
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Bantuan
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>


<div class="col-xl-12 col-lg-12" style="float:left">
        <div class="card">

            <div class="card-body">
              <div class="container">
                <div class="col-xl-4 col-lg-12" style="float:left">
                      <div class="card" style="border:0px solid #eee">
                        <ul class="list-group list-group-flush">
                          <?php
                           foreach ($this->model_global->getDataGlobal('tb_user_manual','type','HEADER')->result() as $val) {
                            ?>
                          <a style="color: #333; border: 1px solid #b0b0b0; border-radius: 0px;" href="<?=base_url()?>user_manual/<?=$val->id_faq?>">
                          <li class="list-group-item" id="faqClicked<?=$val->id_faq?>" style="padding: 11px; border-color: red; cursor: pointer; border-radius: 0px">
                            <?=$val->title?><i class="la la-angle-right" style="float: right;"></i>
                          </li>
                          </a>
                          <?php
                        }
                        ?>                   
                        </ul>
                      </div>
                </div>
                <div class="col-xl-8 col-lg-12" style="float:left">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <?php
                    $no=0;
                    if (empty($this->uri->segment(2))) {
                      $headFaq=1;
                    } else {
                      $headFaq=$this->uri->segment(2);
                    }
                   foreach ($this->model_global->GetdataListFaq($headFaq)->result() as $val2) {
                    $no++;
                    ?>
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" style="background-image: linear-gradient(to right, #9f78ff, #32cafe) !important;" id="headingOne<?=$no?>">
                      <h4 class="panel-title">
                      <a role="button" style="border-radius: 0px;" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?=$no?>" aria-expanded="true" aria-controls="collapseOne<?=$no?>">
                        <?=$val2->title?>
                      </a>
                    </h4>
                    </div>
                    <div id="collapseOne<?=$no?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne<?=$no?>">
                      <div class="panel-body" style="padding: 0px 10px 10px 2px;">
                        <?=$val2->desc?>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                </div>
              </div>
              </div>
            </div>
                    

        </div>
</div>
<!--/ Global settings -->
<script type="text/javascript">
  
  $(document).ready(function () {
    var id='<?=$this->uri->segment(2)?>';
    if (id=='') {
      $("#faqClicked1").addClass('clicked');  
    } else {
      $("#faqClicked"+id).addClass('clicked');
    }
    
  });

</script>
