	<div id="sidebar" class="sidebar  responsive  ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
                                    
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="active">
						<a href="<?php echo base_url()?>index.php/welcome">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
					
                                        <li class="">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon fa fa-user"></i>
							<span class="menu-text"> User </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="<?php echo base_url()?>index.php/user">
									<i class="menu-icon fa fa-caret-right"></i>
									ADD User
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
                                                <ul class="submenu">
							<li class="">
								<a href="<?php echo base_url()?>index.php/user/view">
									<i class="menu-icon fa fa-caret-right"></i>
									List User
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
                                        <li class="">
						<a href="<?php echo base_url()?>index.php/login/logout">
							<i class="menu-icon fa fa-power-off"></i>
							<span class="menu-text"> Logout </span>
						</a>

						<b class="arrow"></b>
					</li>
					
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>