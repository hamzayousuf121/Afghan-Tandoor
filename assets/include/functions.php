<?php

//Function for displaying Select
function showSelect($options, $name, $label, $column = 'name')
{
    if(count($options) > 0)
        echo '<div id="'.$name.'select" class="form-group form-group-sm " >
        <label>'.$label.'</label>
        <select required id="'.$name.'" name="'.$name.'" class="form-control areaselect">
        <option disabled selected value="">Please Select an option</option>';
        foreach($options as $option)
        {
            ?>
                <option value="<?= $option['id']; ?>"><?= $option[$column]; ?></option> 
            <?php
        }
        echo ' </select>
        </div>';
}


//Function to Display ajax
function cartCityAjax()
{
    ?>
    <script>
    //Show Submenu
    function showSelect(currentId, nextId)
    {
            _this = $(currentId);
            $.ajax({
                type: "POST",
                url: "get_details.php?name="+$(_this).attr('name'),
                cache: false,
                data: $("#orderInfoForm").serialize(),
                success: function (data) {
                    $(currentId).after(data);
                }
            });
    }
    
    
    $(document).ready(function() {
        $( '#orderInfoForm' ).on( 'change', 'select', function () 
        { 
            //Get the ID of current selected dropdown
            currentId = $(this).attr('id');
    
            //Hide all of attributes that should apper after current selected one.
            switch(currentId)
            {
                //Remove Area if City is changed, before displaying new area.
                case "country": $("#stateselect").remove();
                case 'state': $("#cityselect").remove();
                case 'city': $("#areaselect").remove();
                default:  
            }
    
            //Show the select that should apper current dropdown.
            showSelect("#"+currentId);
        })
    });
    </script>
    <?php
}
?>