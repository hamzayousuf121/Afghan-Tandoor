 <?php
                                //For Countries
                                $storeId = $partnerstoreId;
                                $stmt = $dbhconnection->prepare("select * from countries where partnerId = ? and storeId = ?");
                                $stmt->execute([$partnerId, $storeId]);
                                $flag = true;    
                                $countryId = NULL;                          
                                if($stmt->rowCount() > 0)
                                {
                                    if($stmt->rowCount() < 2)
                                    {
                                        $stmt = $stmt->fetchAll();
                                        $countryId = $stmt['0']['id'];
                                        ?>
                                            <input type="hidden" name="country" value="<?= $countryId; ?>">
                                        <?php
                                    }
                                    else
                                    {
                                        $flag = false;
                                        showSelect($stmt->fetchAll(), "country", "Country");
                                        
                                    }
                                }

                                //For States
                                if($flag = true)
                                {
                                    $stmt = $dbhconnection->prepare("select * from states where partnerId = ? and storeId = ? and countryId = ? and status=1");
                                    $stmt->execute([$partnerId, $storeId, $countryId]);                 
                                    if($stmt->rowCount() > 0)
                                    {

                                        if($stmt->rowCount() < 2)
                                        {   
                                            $stmt = $stmt->fetchAll();
                                            $countryId = $stmt['0']['id'];
                                            $stateId = $countryId;  
                                            ?>
                                                <input type="hidden" name="state" value="<?= $stateId; ?>">
                                            <?php
                                        }
                                        else
                                        {
                                            $flag = false;
                                            showSelect($stmt->fetchAll(), "state", "Province");
                                        }
                                    }
                                }

                                //For Cities
                                if($flag = true)
                                {
                                    $stmt = $dbhconnection->prepare("select * from cities where partnerId = ? and storeId = ? and stateId = ? order by name asc");
                                    $stmt->execute([$partnerId, $partnerstoreId, $stateId]);                
                                    if($stmt->rowCount() > 0)
                                    {

                                        if($stmt->rowCount() < 2)
                                        {   
                                            $stmt = $stmt->fetchAll();
                                            $cityId = $stmt['0']['id'];
                                            ?>
                                                <input type="hidden" name="city" value="<?= $cityId; ?>">
                                            <?php
                                        }
                                        else
                                        {
                                            $flag = false;
                                            showSelect($stmt->fetchAll(), "city", "City");
                                        }
                                    }
                                }

                                //For Areas
                                if($flag = true)
                                {
                                    $stmt = $dbhconnection->prepare("select * from cities where partnerId = ? and storeId = ? and stateId = ? and cityId = ?");
                                    $stmt->execute([$partnerId, $partnerstoreId, $stateId, $cityId]);                
                                    if($stmt->rowCount() > 0)
                                    {

                                        if($stmt->rowCount() < 2)
                                        {   
                                            $stmt = $stmt->fetchAll();
                                            $areaId = $stmt['0']['id'];
                                            ?>
                                                <input type="hidden" name="area" value="<?= $areaId; ?>">
                                            <?php
                                        }
                                        else
                                        {
                                            $flag = false;
                                            showSelect($stmt->fetchAll(), "area", "Area");
                                        }
                                    }
                                }
                                ?>