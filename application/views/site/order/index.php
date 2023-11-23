<script type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province',
            type: 'POST',
            dataType: 'json',
            headers: {
                'token': '464ef410-6fc8-11ec-9054-0a1729325323'
            },
            contentType: 'application/json; charset=utf-8',
            success: function (result) {
                // CallBack(result);
                $.each(result, function (key, value) {
                    if (key.includes("data"))
                    {
                        $.each(value, function (key2, value2) {
                            $('<option>').val(value2.ProvinceID).text(value2.ProvinceName).appendTo('#province');
                        })
                    }

                })

            },
            error: function (error) {

            }
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.2/axios.min.js" integrity="sha512-b94Z6431JyXY14iSXwgzeZurHHRNkLt9d6bAHt7BZT38eqV+GyngIi/tVye4jBKPYQ2lBdRs0glww4fmpuLRwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#province').change(function (envent) {
            var province = $('#province').val();
            province = parseInt(province);

            $('#district')
                    .empty()
                    .append('<option value>--Chọn Quận,Huyện--</option>');
            $('#ward')
                    .empty()
                    .append('<option value>--Chọn Phường,Xã--</option>');
            $('#ship')
                    .empty()
                    .append('<option value>--Chọn Dịch Vụ--</option>');

            $('#ship_money').val('0');
            $('#ship_label').html('0');
            var total_count = <?php echo $total_amount ?>;
            $('#total_amount').html(formatNumber(total_count));


            $.ajax({
                url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/district',
                type: 'GET',
                dataType: 'json',
                headers: {
                    'token': '464ef410-6fc8-11ec-9054-0a1729325323',
                },
                data: {province_id: province},
                contentType: 'application/json; charset=utf-8',
                success: function (result) {
                    // CallBack(result);
                    $.each(result, function (key, value) {
                        if (key.includes("data"))
                        {
                            $.each(value, function (key2, value2) {
                                $('<option>').val(value2.DistrictID).text(value2.DistrictName).appendTo('#district');
                            })
                        }

                    })

                },
                error: function (error) {

                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#district').change(function (envent) {
            var district = $('#district').val();
            district = parseInt(district);

            $('#ward')
                    .empty()
                    .append('<option value>--Chọn Phường,Xã--</option>');
            $('#ship')
                    .empty()
                    .append('<option value>--Chọn Dịch Vụ Vận Chuyển--</option>');
            $('#ship_money').val('0');
            $('#ship_label').html('0');
            var total_count = <?php echo $total_amount ?>;
            $('#total_amount').html(formatNumber(total_count));

            $.ajax({
                url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/ward',
                type: 'GET',
                dataType: 'json',
                headers: {
                    'token': '464ef410-6fc8-11ec-9054-0a1729325323',
                },
                data: {district_id: district},
                contentType: 'application/json; charset=utf-8',
                success: function (result) {
                    // CallBack(result);

                    $.each(result, function (key, value) {

                        if (key.includes("data"))
                        {
                            $.each(value, function (key2, value2) {
                                $('<option>').val(value2.WardCode).text(value2.WardName).appendTo('#ward');
                            })
                        }

                    })

                },
                error: function (error) {

                }
            });
            var dis = <?php echo $shipping[0]->id_district ?>;
            $.ajax({
                url: 'https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/available-services',
                type: 'GET',
                dataType: 'json',
                headers: {
                    'token': '464ef410-6fc8-11ec-9054-0a1729325323',
                },
                data: {
                    "shop_id": 2413002,
                    "from_district": dis,
                    "to_district": district
                },
                contentType: 'application/json; charset=utf-8',
                success: function (result) {
                    // CallBack(result);
                    $.each(result, function (key, value) {
                        if (key.includes("data"))
                        {
                            $.each(value, function (key2, value2) {
                                $('<option>').val(value2.service_id).text("GHN_Đường bộ").appendTo('#ship');
                            })
                        }

                    })

                },
                error: function (error) {
                    alert("Không thể giao hàng đến Quận,Huyện này!");
                }
            });
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {

        $('#ward').change(function (envent) {
            $('#ship')
                    .empty()
                    .append('<option value>--Chọn Dịch Vụ Vận Chuyển--</option>');
            $('#ship_money').val('0');
            $('#ship_label').html('0');
            var total_count = <?php echo $total_amount ?>;
            $('#total_amount').html(formatNumber(total_count));
            var district = $('#district').val();
            district = parseInt(district);

            var a = $("#province option:selected").text();
            var b = $("#district option:selected").text();
            var c = $("#ward option:selected").text();
            var str = a + ", " + b + ", " + c;
            $('#adress').val(str);
            var dis = <?php echo $shipping[0]->id_district ?>;
            $.ajax({
                url: 'https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/available-services',
                type: 'GET',
                dataType: 'json',
                headers: {
                    'token': '464ef410-6fc8-11ec-9054-0a1729325323',
                },
                data: {
                    "shop_id": 2413002,
                    "from_district": dis,
                    "to_district": district
                },
                contentType: 'application/json; charset=utf-8',
                success: function (result) {
                    // CallBack(result);
                    $.each(result, function (key, value) {
                        if (key.includes("data"))
                        {
                            $.each(value, function (key2, value2) {
                                $('<option>').val(value2.service_id).text("GHN_Đường bộ").appendTo('#ship');
                            })
                        }

                    })

                },
                error: function (error) {
                    alert("Không thể giao hàng đến Quận,Huyện này!");
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {

        $('#ship').change(function (envent) {

            $('#ship_money').val('0');
            $('#ship_label').html('0');
            var total_count = <?php echo $total_amount ?>;
            $('#total_amount').html(formatNumber(total_count));

            var ship = $('#ship').val();
            ship = parseInt(ship);

            var district = $('#district').val();
            district = parseInt(district);

            var ward = $('#ward').val();
            ward = parseInt(district);

            var money = $('.money');
            var money_total = money.text();
            money_total = parseFloat(money_total) * 100;

            var s1 = $('#ship_label');

            $.ajax({
                url: 'https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee',
                type: 'GET',
                dataType: 'json',
                headers: {
                    'token': '464ef410-6fc8-11ec-9054-0a1729325323',
                },
                data: {
                    "service_id": ship,
                    "insurance_value": money_total,
                    "coupon": null,
                    "from_district_id": <?php echo $shipping[0]->id_district ?>,
                    "to_district_id": district,
                    "to_ward_code": ward,
                    "height": 15,
                    "length": 15,
                    "weight": 1000,
                    "width": 15
                },
                contentType: 'application/json; charset=utf-8',
                success: function (result) {
                    // CallBack(result);
                    $.each(result, function (key, value) {
                        if (key.includes("data"))
                        {
                            $.each(value, function (key2, value2) {
                                if (key2.includes("total"))
                                {
                                    $('#ship_money').val(parseFloat(value2));
                                    $('#ship_label').html(formatNumber(value2));
                                    var total_count = <?php echo $total_amount ?> + value2;
                                    $('#total_amount').html(formatNumber(total_count));
                                }
                            })
                        }

                    })

                },
                error: function (error) {

                }
            });
        });
    });
</script>




<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 clearpaddingr">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearpadding">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Trang chủ</a></li>
            <li class="active">Thanh toán</li>
        </ol>
        <?php if (isset($message) && !empty($message)) { ?>
            <h4 style="color:green;text-align: center;margin-top: 30px"><?php echo $message; ?></h4>
        <?php } ?>
        <div class="col-md-12 clearpadding">
            <div class="panel panel-info" >
                <div class="panel-heading cus-color">
                    <h3 class="panel-title">Thông tin thanh toán</h3>
                </div>
                <div class="panel-body">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearpadding">

                        <form id="paymentForm" enctype="multipart/form-data" method="post" >
                            <table class="table" id="order_info">
                                <tbody>
                                    <tr>
                                        <td style="width: 100px">Họ và tên</td>
                                        <td><input id="name" style="min-width: 200px" type="text" value="<?php echo (!empty($user)) ? $user->name : ''; ?>" name="name"><?php echo form_error('name'); ?></td>

                                    </tr>
                                    <tr>
                                        <td>Số điện thoại</td>
                                        <td><input id="phone" style="min-width: 200px" name="phone" type="text" value="<?php echo (!empty($user)) ? $user->phone : ''; ?>"><?php echo form_error('phone'); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tỉnh,ThànhPhố</td>
                                        <td><select class="form-control" name="province" id="province" style="max-width: 200px;padding: 5px">
                                                <option value>--Chọn Tỉnh,Thành phố--</option>

                                            </select>
                                            <div class="col-sm-12">
                                                <?php echo form_error('province'); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Quận,Huyện</td>
                                        <td><select class="form-control" name="district" id="district" style="max-width: 200px;padding: 5px">
                                                <option value>--Chọn Quận,Huyện--</option>
                                            </select>
                                            <div class="col-sm-12">
                                                <?php echo form_error('district'); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Phường, Xã</td>
                                        <td><select class="form-control" name="ward" id="ward" style="padding: 5px;max-width: 200px;">
                                                <option value>--Chọn Phường,Xã--</option>
                                            </select>
                                            <div class="col-sm-12">
                                                <?php echo form_error('ward'); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Địa chỉ cụ thể</td>
                                        <td><input id="area" style="min-width: 200px" name="area" type="text" value="<?php echo (!empty($user)) ? $user->address : ''; ?>"><?php echo form_error('address'); ?></td>
                                        <td><input style="max-width: 200px" id="adress" name="adress" type="hidden" value=""></td>
                                    </tr>
                                    <tr>
                                        <td>Dịch vụ vận chuyển</td>
                                        <td><select class="form-control" name="ship" id="ship" style="max-width: 200px;padding: 5px">
                                                <option value>--Chọn Dịch Vụ--</option>

                                            </select>
                                            <div class="col-sm-12">
                                                <?php echo form_error('province'); ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td >Tổng tiền</td>
                                        <td>
                                            <span class="money" ><?php echo number_format($total_amount); ?></span>
                                        </td>
                                        <td>VNĐ</td>
                                    </tr>

                                    <tr>
                                        <td>Phí ship</td>
                                        <td>
                                            <span id="ship_label"> 0<span/>

                                        </td>
                                        <td>VNĐ<input style="max-width: 100px" type="hidden" name="ship_money" id="ship_money" value="0" ></td>
                                    </tr>

                                    <tr>
                                        <td>Thành tiền</td>
                                        <td style="color: red;max-width: 50px">
                                            <span id="total_amount" ><?php echo number_format($total_amount); ?></span>
                                        </td>
                                        <td>VNĐ</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td >

                                        </td>
                                        <td></td>

                                    </tr>

                                </tbody>
                            </table>
                            <div class="col-lg-8">
                                <input type="radio" style="width: 48px; margin-right: 12px" name="methodPayment">
                                <div class="col-lg-5"><image style="width: 100%; height: 100%" src="<?php echo base_url(); ?>upload/van_chuyen.png" /></div>
                                <div class="col-lg-5">Đơn vị vận chuyển<p>GHN - Giao hàng nhanh toàn quốc</p></div>
                            </div>
                            <div class="col-lg-8">
                                <input onclick="payOnline()" type="radio" style="width: 48px; margin-right: 12px" name="methodPayment">
                                <img src="https://play-lh.googleusercontent.com/dQbjuW6Jrwzavx7UCwvGzA_sleZe3-Km1KISpMLGVf1Be5N6hN6-tdKxE5RDQvOiGRg=w240-h480-rw" alt="">
                                <div >Thanh toán online bằng ví momo</div>
                            </div>
                            <button style="min-width: 100px;float: right;margin-top: 50px" type="submit" class="btn btn-success">Xác nhận</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>	
    </div>
</div>
<script>
    var popupWindow;
    async function payOnline() {
        const name= document.getElementById("name").value
        const phone=document.getElementById("phone").value
        const province= document.getElementById("province").value
        const district= document.getElementById("district").value
        const ward= document.getElementById("ward").value
        const area= document.getElementById("area").value
        const ship= document.getElementById("ship").value
        const ship_label=document.getElementById("ship_money").value
        const amount=document.getElementById("total_amount").innerHTML.replaceAll(",", "")
        const res=await axios({
            url: "https://payment-momo.onrender.com/payment-momo",
            method: "post",
            data: {
                platform: "web",
                amount: 50000,
                url_web: "http://localhost/shopbanquanao/payment-success.php"
            }
        })
        const result=await res.data
        localStorage.setItem("orderId", result.orderId)
        localStorage.setItem("amount", result.amount)
        localStorage.setItem("dataDelivery", JSON.stringify({name, phone, province,district,ward,area,ship,ship_label, amount}))
        // window.location.href= result.payUrl
        popupWindow= window.open(result.payUrl, "_blank", "width=1000, height= 600")
        return result
    }
</script>
<script>
    
    async function checkTransaction() {
        
        if(localStorage.getItem("orderId") && popupWindow) {
            const name= document.getElementById("name")
            const phone=document.getElementById("phone")
            const province= document.getElementById("province")
            const district= document.getElementById("district")
            const ward= document.getElementById("ward")
            const area= document.getElementById("area")
            const ship= document.getElementById("ship")
            const ship_label=document.getElementById("ship_money")
            const amount=document.getElementById("total_amount")
            const dataDelivery=JSON.parse(localStorage.getItem("dataDelivery"))
            const orderId= localStorage.getItem("orderId")
            const res=await axios({
            url: "https://payment-momo.onrender.com/payment-status",
            method: "post",
            data: {
                orderId: orderId,
                amount: 50000,
                url_web: "http://localhost/shopbanquanao/payment-success.php"
            }
        })
            const result=await res.data
            if(result?.resultCode== 0) {
                swal("Thông báo", "Giao dịch thành công", "success")
                .then(()=> {
                    popupWindow.close()
                    document.getElementById("paymentForm").submit()
                })
                .then(()=> {
                    localStorage.removeItem("orderId")
                    localStorage.removeItem("amount")
                    localStorage.removeItem("dataDelivery")
                })

            }
            else if(result?.resultCode !== 1000) {
                swal("Thông báo", "Giao dịch thất bại ", "error")
            }
            console.log(result)
        }
    }
    setInterval(()=> {
        checkTransaction()
    }, 3000);
</script>