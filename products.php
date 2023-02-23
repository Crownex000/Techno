<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Techno3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <style>
        table{
                margin: 0px 20px;
                text-align: center;
                border-collapse: collapse;
            }
        th,td{
            border-bottom: 1px solid lightgray;
        }
    </style>
</head>
<script>
   $(document).ready(function() {
    $(document).on('click', 'input[type="submit"]', function(event) {
        var pitem = $(this).attr('alt-value');
        var sitem = $(this).attr('id');
        var rows = [];
        $('#' + sitem).each(function() {
            var row = {};
            $(this).find('td[id]').not(':last-child').each(function() {
                var key = $(this).attr('id');
                var value = $(this).text();
                row[key] = value;
            });
            rows.push(row);
        });
        console.log(rows);
        $('#orders').val(rows);
        $.post('techno_controller/item', {item_select: rows}, function(data) {
            }).done(function(data){
                location.reload();
            });
        //$('#b_'+pitem).attr('disabled', true);
        //$("#for_"+pitem).collapse('hide'); ---- for accordion
    });
});
</script>
<body>
    <label for="price_range" class="form-label">PRICE:</label>
    <input type="range" class="form-range" min="1" max="5" id="price_range">
    <div class="d-flex justify-content-between">
    <span>1</span>
    <span>5</span>
    </div>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Base Price</th>
                <th>Retail Store 1 Price</th>
                <th>Retail Store 2 Price</th>
                <th>Retail Store 3 Price</th>
                <th><input type="hidden"></th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($data)){
            foreach($data as $value){
        ?>
            <tr id="<?=$value['productname']?>">
                <td id="ptype" hidden><?=$value['ptype']?></td>
                <td id="pname"><?=$value['productname']?></td>
                <td id="bprice"><?=$value['price']?></td>
                <td id="rp1" hidden><?=$value['rs1']?></td>
                <td id="rp2" hidden><?=$value['rs2']?></td>
                <td id="rp3" hidden><?=$value['rs3']?></td>
                <td><input class="btn btn-dark" type="submit" value="Add" id="<?=$value['productname']?>" alt-value="<?=$value['ptype']?>" data-bs-dismiss="modal"></td>
            </tr>
            <?php
            }
        }else{
        ?>
        </tbody>
    </table>
    <h1>No Data</h1>
        <?php
             
        }
        ?>
</body>
</html>