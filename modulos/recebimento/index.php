<?php

include '../../config/mysql.php';
include '../../config/check.php';
include '../../config/funcoes.php';

?>
<div class="widget gray">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i> Aplicativos</h4>
                            <span class="tools">
                            </span>
                    </div>
                    <div class="widget-body">
                                <!--BEGIN METRO STATES-->
                                <div class="metro-nav metro-fix-view">
                                    <?php

										echo metronav('boletos','boletos','Boletos',numeroentradas('boletos',''),'icon-barcode','green','double');
										echo metronav('intermediarios','intermediarios','Intermediários',numeroentradas('intermediarios',''),'icon-credit-card','orange','double');
									?>
                                </div>

                                
                                <div class="clearfix"></div>
                                <!--END METRO STATES-->
                            </div>
</div>
                        <!-- BEGIN BASIC PORTLET-->
