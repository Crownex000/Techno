<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Techno2</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <style>
            .container button{
                width:100px;
                height: 40px;
                margin: 5px;
                font-size: 10px;
            }
            .modal.fade {
                transition-duration: 1s;
            }
            #val_base{
                font-weight: bold;
            }
            #val_0{
                color: black;
            }
            #val_1{
                color: green;
            }
            #val_2{
                color: red;
            }
        </style>
    </head>
    <script>
         $(document).ready(function(){
            $('th button').click(function(a){
                a.stopPropagation();
                var product = $(this).attr('data-value');
                $('#form_'+product).submit(function(b){
                    b.stopPropagation();
                    b.preventDefault();
                    $.post('techno_controller/products',$(this).serialize(),function(data){
                    }, "html").done(function(data){
                        $('.modal-body').html(data);
                    });
                }); 
            });
            $('td .btn-close').click(function(){
                var del_item= $(this).attr('data-value')
                $.post('techno_controller/del_item',{delitem: del_item},function(data2){
                    }, "html").done(function(data2){
                        location.reload();
                    });
            });
        });
    </script>
    <?php
    //fetch data w/ conditional
    $cpu_data = !empty($sdata['CPU']) ? $sdata['CPU'] : array("");
    $cpu_cooler_data = !empty($sdata['CPU_cooler']) ? $sdata['CPU_cooler'] : array("");
    $motherboard_data = !empty($sdata['motherboard']) ? $sdata['motherboard'] : array("") ;
    $ram_data = !empty($sdata['RAM']) ? $sdata['RAM'] : array("");
    $storage_data = !empty($sdata['storage']) ? $sdata['storage'] : array("");
    $video_card_data = !empty($sdata['video_card']) ? $sdata['video_card'] : array("");
    $power_supply_data = !empty($sdata['power_supply']) ? $sdata['power_supply'] : array("");
    $case_data = !empty($sdata['case']) ?  $sdata['case'] : array("");

    //access data
    $item_cpu = $cpu_data[0];
    $item_cpu_cooler = $cpu_cooler_data[0];
    $item_motherboard = $motherboard_data[0];
    $item_ram = $ram_data[0];
    $item_storage = $storage_data[0];
    $item_video_card = $video_card_data[0];
    $item_power_supply = $power_supply_data[0];
    $item_case = $case_data[0];

    //remove buttons
    $cpu_remove_button = !empty($sdata['CPU']) ? "<button type='button' id='rb_CPU' class='btn-close' aria-label='Close' data-value='CPU'></button>" : "";
    $cpu_cooler_remove_button = !empty($sdata['CPU_cooler']) ? "<button type='button' id='rb_CPU_cooler' class='btn-close' aria-label='Close' data-value='CPU_cooler'></button>" : "";
    $motherboard_remove_button = !empty($sdata['motherboard']) ? "<button type='button' id='rb_motherboard' class='btn-close' aria-label='Close' data-value='motherboard'></button>" : "";
    $ram_remove_button = !empty($sdata['RAM']) ? "<button type='button' id='rb_RAM' class='btn-close' aria-label='Close' data-value='RAM'></button>" : "";
    $storage_remove_button = !empty($sdata['storage']) ? "<button type='button' id='rb_storage' class='btn-close' aria-label='Close' data-value='storage'></button>" : "";
    $video_card_remove_button = !empty($sdata['video_card']) ? "<button type='button' id='rb_video_card' class='btn-close' aria-label='Close' data-value='video_card'></button>" : "";
    $power_supply_remove_button = !empty($sdata['power_supply']) ? "<button type='button' id='rb_power_supply' class='btn-close' aria-label='Close' data-value='power_supply'></button>" : "";
    $case_remove_button = !empty($sdata['case']) ? "<button type='button' id='rb_case' class='btn-close' aria-label='Close' data-value='case'></button>" : "";
    ?>
    <body>
    <h3 id="orders"></h3>
        <div class="container">
            <table class="table table-light table-hover">
                <thead>
                    <tr>
                        <th scope="col">Component</th>
                        <th scope="col">Selection</th>
                        <th scope="col">Base Value</th>
                        <th scope="col">Retail Store 1</th>
                        <th scope="col">Retail Store 2</th>
                        <th scope="col">Retail Store 3</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" id="table_builder">
                    <tr id="tr_CPU">
                        <form action="products" method="post" id="form_CPU">
                            <input type="hidden" name="part_item" value="CPU">
                            <th scope="CPU" id="th_CPU">
                                <button class="btn btn-dark" type="submit" data-bs-toggle="modal" data-bs-target="#product_modal" data-value="CPU" id="b_CPU">+ Add CPU</button>
                            </th>
                        </form>
                        <td><?=!empty($item_cpu['pname']) ? $item_cpu['pname'] : "" ?></td>
                        <td id="val_base"><?=!empty($item_cpu['bprice']) ? '<sup>₱</sup>'. $item_cpu['bprice'] : "" ?></td>
                        <td id="val_<?=!empty($item_cpu['rp1']) ? (($item_cpu['rp1']==$item_cpu['bprice']) ? 0 : (($item_cpu['rp1']<$item_cpu['bprice']) ? 1 : (($item_cpu['rp1']>$item_cpu['bprice']) ? 2 : 0 ))) : ""?>"><?=!empty($item_cpu['rp1']) ? '<sup>₱</sup>'.$item_cpu['rp1'] : "" ?></td>
                        <td id="val_<?=!empty($item_cpu['rp2']) ? (($item_cpu['rp2']==$item_cpu['bprice']) ? 0 : (($item_cpu['rp2']<$item_cpu['bprice']) ? 1 : (($item_cpu['rp2']>$item_cpu['bprice']) ? 2 : 0 ))) : ""?>"><?=!empty($item_cpu['rp2']) ? '<sup>₱</sup>'.$item_cpu['rp2'] : "" ?></td>
                        <td id="val_<?=!empty($item_cpu['rp2']) ? (($item_cpu['rp3']==$item_cpu['bprice']) ? 0 : (($item_cpu['rp3']<$item_cpu['bprice']) ? 1 : (($item_cpu['rp3']>$item_cpu['bprice']) ? 2 : 0 ))) : ""?>"><?=!empty($item_cpu['rp3']) ? '<sup>₱</sup>'.$item_cpu['rp3'] : ""?></td>
                        <td><?=$cpu_remove_button?></td>
                    </tr>
                    <tr id="tr_CPU_cooler">
                        <form action="products" method="post" id="form_CPU_cooler">
                            <input type="hidden" name="part_item" value="CPU_cooler">
                            <th scope="CPU_cooler" id="th_CPU_cooler">
                                <button class="btn btn-dark" type="submit" data-bs-toggle="modal" data-bs-target="#product_modal" data-value="CPU_cooler" id="b_CPU_cooler">+ Add CPU Cooler</button>
                            </th>
                        </form>
                        <td><?=!empty($item_cpu_cooler['pname']) ? $item_cpu_cooler['pname'] : "" ?></td>
                        <td><?=!empty($item_cpu_cooler['bprice']) ? $item_cpu_cooler['bprice'] : "" ?></td>
                        <td><?=!empty($item_cpu_cooler['rp1']) ? $item_cpu_cooler['rp1'] : "" ?></td>
                        <td><?=!empty($item_cpu_cooler['rp2']) ? $item_cpu_cooler['rp2'] : "" ?></td>
                        <td><?=!empty($item_cpu_cooler['rp3']) ? $item_cpu_cooler['rp3'] : ""?></td>
                        <td><?=$cpu_cooler_remove_button?></td>
                    </tr>
                    <tr id="tr_motherboard">
                        <form action="products" method="post" id="form_motherboard">
                            <input type="hidden" name="part_item" value="motherboard">
                            <th scope="motherboard" id="th_motherboard">
                                <button class="btn btn-dark" type="submit" data-bs-toggle="modal" data-bs-target="#product_modal" data-value="motherboard" id="b_motherboard">+ Add Motherboard</button>
                            </th>
                         </form>
                        <td><?=!empty($item_motherboard['pname']) ? $item_motherboard['pname'] : "" ?></td>
                        <td><?=!empty($item_motherboard['bprice']) ? $item_motherboard['bprice'] : "" ?></td>
                        <td><?=!empty($item_motherboard['rp1']) ? $item_motherboard['rp1'] : "" ?></td>
                        <td><?=!empty($item_motherboard['rp2']) ? $item_motherboard['rp2'] : "" ?></td>
                        <td><?=!empty($item_motherboard['rp3']) ? $item_motherboard['rp3'] : ""?></td>
                        <td><?=$motherboard_remove_button?></td>
                    </tr>
                    <tr id="tr_RAM">
                        <form action="products" method="post" id="form_RAM">
                            <input type="hidden" name="part_item" value="RAM">
                            <th scope="RAM" id="th_RAM">
                                <button class="btn btn-dark" type="submit" data-bs-toggle="modal" data-bs-target="#product_modal" data-value="RAM" id="b_RAM">+ Add RAM</button>
                            </th>
                         </form>
                        <td><?=!empty($item_ram['pname']) ? $item_ram['pname'] : "" ?></td>
                        <td><?=!empty($item_ram['bprice']) ? $item_ram['bprice'] : "" ?></td>
                        <td><?=!empty($item_ram['rp1']) ? $item_ram['rp1'] : "" ?></td>
                        <td><?=!empty($item_ram['rp2']) ? $item_ram['rp2'] : "" ?></td>
                        <td><?=!empty($item_ram['rp3']) ? $item_ram['rp3'] : ""?></td>
                        <td><?=$ram_remove_button?></td>
                    </tr>
                    <tr id="tr_storage">
                        <form action="products" method="post" id="form_storage">
                            <input type="hidden" name="part_item" value="storage">
                            <th scope="storage" id="th_storage">
                                <button class="btn btn-dark" type="submit" data-bs-toggle="modal" data-bs-target="#product_modal" data-value="storage" id="b_storage">+ Add Storage</button>
                            </th>
                         </form>
                        <td><?=!empty($item_storage['pname']) ? $item_storage['pname'] : "" ?></td>
                        <td><?=!empty($item_storage['bprice']) ? $item_storage['bprice'] : "" ?></td>
                        <td><?=!empty($item_storage['rp1']) ? $item_storage['rp1'] : "" ?></td>
                        <td><?=!empty($item_storage['rp2']) ? $item_storage['rp2'] : "" ?></td>
                        <td><?=!empty($item_storage['rp3']) ? $item_storage['rp3'] : ""?></td>
                        <td><?=$storage_remove_button?></td>
                    </tr>
                    <tr id="tr_video_card">
                        <form action="products" method="post" id="form_video_card">
                            <input type="hidden" name="part_item" value="video_card">
                            <th scope="video_card" id="th_video_card">
                                <button class="btn btn-dark" type="submit" data-bs-toggle="modal" data-bs-target="#product_modal" data-value="video_card" id="b_video_card">+ Add Video Card</button>
                            </th>
                         </form>
                        <td><?=!empty($item_video_card['pname']) ? $item_video_card['pname'] : "" ?></td>
                        <td><?=!empty($item_video_card['bprice']) ? $item_video_card['bprice'] : "" ?></td>
                        <td><?=!empty($item_video_card['rp1']) ? $item_video_card['rp1'] : "" ?></td>
                        <td><?=!empty($item_video_card['rp2']) ? $item_video_card['rp2'] : "" ?></td>
                        <td><?=!empty($item_video_card['rp3']) ? $video_card_data['rp3'] : ""?></td>
                        <td><?=$video_card_remove_button?></td>
                    </tr>
                    <tr id="tr_power_supply">
                        <form action="products" method="post" id="form_power_supply">
                            <input type="hidden" name="part_item" value="power_supply">
                            <th scope="power_supply" id="th_power_supply">
                                <button class="btn btn-dark" type="submit" data-bs-toggle="modal" data-bs-target="#product_modal" data-value="power_supply" id="b_power_supply">+ Add Power Supply</button>
                            </th>
                         </form>
                        <td><?=!empty($item_power_supply['pname']) ? $item_power_supply['pname'] : "" ?></td>
                        <td><?=!empty($item_power_supply['bprice']) ? $item_power_supply['bprice'] : "" ?></td>
                        <td><?=!empty($item_power_supply['rp1']) ? $item_power_supply['rp1'] : "" ?></td>
                        <td><?=!empty($item_power_supply['rp2']) ? $item_power_supply['rp2'] : "" ?></td>
                        <td><?=!empty($item_power_supply['rp3']) ? $item_power_supply['rp3'] : ""?></td>
                        <td><?=$power_supply_remove_button?></td>
                    </tr>
                    <tr id="tr_case">
                        <form action="products" method="post" id="form_case">
                            <input type="hidden" name="part_item" value="case">
                            <th scope="case" id="th_case">
                                <button class="btn btn-dark" type="submit" data-bs-toggle="modal" data-bs-target="#product_modal" data-value="case" id="b_case">+ Add Case</button>
                            </th>
                         </form>
                        <td><?=!empty($item_case['pname']) ? $item_case['pname'] : "" ?></td>
                        <td><?=!empty($item_case['bprice']) ? $item_case['bprice'] : "" ?></td>
                        <td><?=!empty($item_case['rp1']) ? $item_case['rp1'] : "" ?></td>
                        <td><?=!empty($item_case['rp2']) ? $item_case['rp2'] : "" ?></td>
                        <td><?=!empty($item_case['rp3']) ? $item_case['rp3'] : ""?></td>
                        <td><?=$case_remove_button?></td>
                    </tr>
                </tbody>
            </table>
            <div class="modal top fade" id="product_modal" tabindex="-1" aria-labelledby="product_modal" aria-hidden="true" data-bs-backdrop="true" data-bs-keyboard="true">
                    <div class="modal-dialog modal-fullscreen">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="product_modal_label">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>