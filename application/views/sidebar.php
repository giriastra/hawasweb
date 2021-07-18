    <style>
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  right: 0;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1;}
.dropdown:hover .dropdown-content {display: block;}
.dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true" data-img="theme-assets/images/backgrounds/02.jpg">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">       
          <li class="nav-item mr-auto"><a class="navbar-brand" href="<?=base_url()?>"><img class="brand-logo" alt="Chameleon admin logo" src="<?=base_url()?>assets/img/hawas_logo.png"/>
              <h3 class="brand-text">Hawas Admin</h3></a></li>
          <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
      </div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <?php
          $no=0;
            foreach ($this->model_global->daftar_menu()->result_array() as $row) {
          if ($row['type_menu']=='SOLO') {
          $no++;
          ?>
          <li class="nav-item" id="<?=$row['link']?>"><a href="<?=base_url()?><?=$row['link']?>"><i class="<?=$row['icon']?>"></i><span class="menu-title" data-i18n=""><?=$row['nama_menu']?></span></a>
          </li>
          <?php
          } else if ($row['type_menu']=='HEADER') {
          ?>
          <li class="nav-item has-sub "><a href="#"><i class="<?=$row['icon']?>"></i><span class="menu-title" data-i18n=""><?=$row['nama_menu']?></span></a>
            <ul class="menu-content" style="">             
            
            <?php  foreach ($this->model_global->GetListGroup($row['id_group'])->result() as $list) {?>
            	<li class="is-shown"><a class="menu-item" href="<?=base_url()?><?=$list->link?>"><?=$list->nama_menu?></a></li>
            <?php } ?>              

          	</ul>
          </li>
        <?php 
      } 
    }
      ?>

        </ul>
      </div>
      <div class="navigation-background"></div>
    </div>


    <script type="text/javascript">
      var uri = '<?=$this->uri->segment(1)?>';

        $(document).ready(function(){     
        $(".hideShow").hide();   
        $("#"+uri).addClass('active');

          

      });

        function Toogle(noID){
          $(".dropdownParam"+noID).toggle();
        }
    </script>