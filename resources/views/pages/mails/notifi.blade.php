<table align="center" cellpadding="0" cellspacing="0">
    <tbody><tr>
    <td style="padding:20px 30px;width:auto">
    
    <table cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:white;width:100%;margin:auto">  
    <tbody>  
    <tr>
        <td>
            <table cellpadding="0" cellspacing="0" style="border-collapse:collapse;font-size:12px">
                <tbody><tr>
                    
                    <td style="padding-left:20px;padding-right:20px;padding-bottom:30px;font-family:verdana,arial;padding-top:10px">
                       
                      <h3 style="font-size:18px;font-weight:500">Cảm ơn <span style="color:#ce0707">{{$name}}</span> đã đặt hàng tại <a href="{{url('/')}}" target="_blank">ISMART</a></h3>
                      <p style="font-weight:600;font-size:14px">Đơn hàng của quý khách đã được gửi thành công!</p>
                      <p>ISMART sẽ gọi điện cho Quý khách trong vòng 24 giờ<br></p>
                     <p><b style="text-transform:uppercase">Chú ý:</b>  Quý khách vui lòng xác nhận hàng với nhân viên kinh doanh trước khi chuyển tiền</p>
                     
    <table style="width:100%;border-spacing:inherit;border:1px solid #ddd">
        <tbody>
        <tr style="background-color:#ce0707;font-weight:bold">
            <td style="padding:10px;border-right:1px solid #ddd;color:white; text-transform:uppercase">THÔNG TIN đơn hàng {{$code}}</td>
        </tr>
        <tr style=" margin-bottom:10px">
            <td style=" padding-left:10px">Họ và tên: <b style="color:#ce0707">{{$name}}</b> </td>
        </tr>
        <tr style=" margin-bottom:10px">
            <td style=" padding-left:10px">Email: <b style="color:#ce0707">{{$email}}</b></td>
        </tr>
        <tr style=" margin-bottom:10px">
            <td style=" padding-left:10px">Số điệnt thoại: <b style="color:#ce0707">{{$phone}}</b></td>
        </tr>
        <tr style=" margin-bottom:10px">
            <td style=" padding-left:10px">Địa chỉ: <b style="color:#ce0707">{{$address}}</b></td>
        </tr>
        <tr style=" margin-bottom:10px">
            <td style=" padding-left:10px">Ghi chú đơn hàng: <b style="color:#ce0707">{{$note}}</b></td>
        </tr>
    </tbody></table>
    <h3 style="font-weight:500">CHI TIẾT ĐƠN HÀNG</h3>
        <table id="m_-3084575297159416309nddh" style="border-collapse:collapse;width:100%;color:#333" border="1">
            <tbody><tr style="background-color:#ce0707;font-weight:bold;color:white">
                <td style="padding:10px;width:5%">STT</td>
                <td style="padding:10px;width:30%">SẢN PHẨM</td>
                <td style="padding:10px;width:25%">GIÁ SẢN PHẨM</td>
                <td style="padding:10px;width:15%">SỐ LƯỢNG</td>
                <td style="padding:10px;width:25%">THÀNH TIỀN</td>
            </tr>
            @php
                $t = 0
            @endphp
            @foreach ($order_details as $item)
                @php
                    $t++
                @endphp
            <tr>
             <td align="center" style="padding:4px">{{$t}}</td>
             <td style="padding:4px">
                 {{$item->product_name}}
   
             </td>
             <td align="center" style="padding:4px">{{number_format($item->product_price,0,'','.')}}<u>đ</u></td>
             <td align="center" style="padding:4px">{{$item->product_qty}}</td>
             <td align="center" style="padding:4px">{{number_format(($item->product_price * $item->product_qty),0,'','.')}}<u>đ</u></td>
             </tr>
             @endforeach
           
            
   
            <tr style="font-weight:bold">
                <td colspan="4" align="right" style="padding:4px;text-align:right">
                   Tổng giá trị đơn hàng
                </td>
                <td colspan="2" style="padding:4px">
                    {{number_format($total,0,'','.')}}<u>đ</u>
                </td>
            </tr>   
                
               
        </tbody>
        </table>
        
                </td>
            </tr>
            </tbody>
        </table>
        </td>
    </tr>   
          
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>