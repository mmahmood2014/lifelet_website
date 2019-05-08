<?php
if($discount_cent!='Free Shipping'){
	$discount_cent=number_format($discount_cent);
	$discount_cent=$discount_cent.'%';
}
$str='<table class="header row" style="width: 100%; border-spacing: 0; border-collapse: collapse; margin: 40px 0 20px">
   <tbody>
      <tr>
         <td class="header__cell" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif">
            <center>
               <table class="container" style="width: 560px; text-align: left; border-spacing: 0; border-collapse: collapse; margin: 0 auto">
                  <tbody>
                     <tr>
                        <td style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif">
                           <table class="row" style="width: 100%; border-spacing: 0; border-collapse: collapse">
                              <tbody>
                                 <tr>
                                    <td class="shop-name__cell" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif">
                                       <img src="https://cdn.shopify.com/s/files/1/0046/9473/6965/email_settings/LIFElet_Logo_RGB_Colour.png?15873645685304942180" alt="LIFElet" width="180">
                                    </td>
                                    <td class="order-number__cell" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; text-transform: uppercase; font-size: 14px; color: #999" align="right">
                                       <span class="order-number__text" style="font-size: 16px">
                                       Order #'.$order_number_shopify.'
                                       </span>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </center>
         </td>
      </tr>
   </tbody>
</table>';


$str.='<table class="row content" style="width: 100%; border-spacing: 0; border-collapse: collapse">
   <tbody>
      <tr>
         <td class="content__cell" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; padding-bottom: 40px">
            <center>
               <table class="container" style="width: 560px; text-align: left; border-spacing: 0; border-collapse: collapse; margin: 0 auto">
                  <tbody>
                     <tr>
                        <td style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif">
                           <h2 style="font-weight: normal; font-size: 24px; margin: 0 0 10px">Thank you for your purchase! </h2>
                           <p style="color: #777; line-height: 150%; font-size: 16px; margin: 0">
                              Hi '.$fname.', we are getting your order ready to be shipped. Please allow 1-3 business days for the creation and processing of your order. We will notify you when your order has been shipped.
                           </p>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </center>
         </td>
      </tr>
   </tbody>
</table>';

$str.='<table class="row section" style="width: 100%; border-spacing: 0; border-collapse: collapse; border-top-width: 1px; border-top-color: #e5e5e5; border-top-style: solid">
   <tbody>
      <tr>
         <td class="section__cell" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; padding: 40px 0">
            <center>
               <table class="container" style="width: 560px; text-align: left; border-spacing: 0; border-collapse: collapse; margin: 0 auto">
                  <tbody>
                     <tr>
                        <td style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif">
                           <h3 style="font-weight: normal; font-size: 20px; margin: 0 0 25px">Order summary</h3>
                        </td>
                     </tr>
                  </tbody>
               </table>
               <table class="container" style="width: 560px; text-align: left; border-spacing: 0; border-collapse: collapse; margin: 0 auto">
                  <tbody>
                     <tr>
                        <td style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif">
                           <table class="row" style="width: 100%; border-spacing: 0; border-collapse: collapse">
                              <tbody>
                              '.$a.'
							  </tbody>
                           </table>
						   <table class="row subtotal-table" style="width: 100%; border-spacing: 0; border-collapse: collapse; margin-top: 20px">
							  <tbody>
								 <tr>
									<td colspan="2" class="subtotal-table__line" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; border-bottom-width: 1px; border-bottom-color: #e5e5e5; border-bottom-style: solid; height: 1px; padding: 0"></td>
								 </tr>
								 <tr>
									<td colspan="2" class="subtotal-table__small-space" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; height: 10px"></td>
								 </tr>
							  </tbody>
						   </table>
                           <table class="row subtotal-lines" style="width: 100%; border-spacing: 0; border-collapse: collapse; margin-top: 15px; border-top-width: 1px; border-top-color: #e5e5e5; border-top-style: solid_">
                              <tbody>
                                 <tr>
                                    <td class="subtotal-spacer" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; width: 40%"></td>
                                    <td style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif">
                                       <table class="row subtotal-table" style="width: 100%; border-spacing: 0; border-collapse: collapse; margin-top: 20px">
                                          <tbody>
                                             <tr class="subtotal-line">
                                                <td class="subtotal-line__title" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; padding: 5px 0">
                                                   <p style="color: #777; line-height: 1.2em; font-size: 16px; margin: 0">
                                                      <span style="font-size: 16px">Subtotal</span>
                                                   </p>
                                                </td>
                                                <td class="subtotal-line__value" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; padding: 5px 0" align="right">
                                                   <strong style="font-size: 16px; color: #555">$'.number_format($subTotal_E,2).'</strong>
                                                </td>
                                             </tr>
                                             <tr class="subtotal-line">
                                                <td class="subtotal-line__title" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; padding: 5px 0">
                                                   <p style="color: #777; line-height: 1.2em; font-size: 16px; margin: 0">
                                                      <span style="font-size: 16px">Discount</span>
                                                   </p>
                                                </td>
                                                <td class="subtotal-line__value" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; padding: 5px 0" align="right">
                                                   <strong style="font-size: 16px; color: #555">'.$discount_cent.'</strong>
                                                </td>
                                             </tr>
											 <tr class="subtotal-line">
                                                <td class="subtotal-line__title" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; padding: 5px 0">
                                                   <p style="color: #777; line-height: 1.2em; font-size: 16px; margin: 0">
                                                      <span style="font-size: 16px">Shipping</span>
                                                   </p>
                                                </td>
                                                <td class="subtotal-line__value" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; padding: 5px 0" align="right">
                                                   <strong style="font-size: 16px; color: #555">$'.number_format($shipping,2).'</strong>
                                                </td>
                                             </tr>
                                             <tr class="subtotal-line">
                                                <td class="subtotal-line__title" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; padding: 5px 0">
                                                   <p style="color: #777; line-height: 1.2em; font-size: 16px; margin: 0">
                                                      <span style="font-size: 16px">Taxes</span>
                                                   </p>
                                                </td>
                                                <td class="subtotal-line__value" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; padding: 5px 0" align="right">
                                                   <strong style="font-size: 16px; color: #555">$'.number_format($tax,2).'</strong>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                       <table class="row subtotal-table subtotal-table--total" style="width: 100%; border-spacing: 0; border-collapse: collapse; margin-top: 20px; border-top-width: 2px; border-top-color: #e5e5e5; border-top-style: solid">
                                          <tbody>
                                             <tr class="subtotal-line">
                                                <td class="subtotal-line__title" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; padding: 20px 0 0">
                                                   <p style="color: #777; line-height: 1.2em; font-size: 16px; margin: 0">
                                                      <span style="font-size: 16px">Total</span>
                                                   </p>
                                                </td>
                                                <td class="subtotal-line__value" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; padding: 20px 0 0" align="right">
                                                   <strong style="font-size: 24px; color: #555">$'.number_format($grand_total,2).' CAD</strong>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                       <table class="row subtotal-table" style="width: 100%; border-spacing: 0; border-collapse: collapse; margin-top: 20px">
                                          <tbody>
                                             <tr>
                                                <td colspan="2" class="subtotal-table__line" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; border-bottom-width: 1px; border-bottom-color: #e5e5e5; border-bottom-style: solid; height: 1px; padding: 0"></td>
                                             </tr>
                                             <tr>
                                                <td colspan="2" class="subtotal-table__small-space" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; height: 10px"></td>
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
            </center>
         </td>
      </tr>
   </tbody>
</table>';


$str.='<table class="container" style="width: 560px; text-align: left; border-spacing: 0; border-collapse: collapse; margin: 0 auto">
   <tbody>
      <tr>
         <td style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif">
            <table class="row" style="width: 100%; border-spacing: 0; border-collapse: collapse">
               <tbody>
                  <tr>
                     <td class="customer-info__item" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; width: 50%">
                        <h4 style="font-weight: 500; font-size: 16px; color: #555; margin: 0 0 5px">Shipping Address</h4>
                        <p style="color: #777; line-height: 150%; font-size: 16px; margin: 0">'.$fname.' '.$lname.'<br>'.$address1.'<br>'.$city.' '.$province.' '.$zip.'<br>'.$country.'</p>
                     </td>
                     <td class="customer-info__item" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; width: 50%">
                        <h4 style="font-weight: 500; font-size: 16px; color: #555; margin: 0 0 5px">Billing Address</h4>
                        <p style="color: #777; line-height: 150%; font-size: 16px; margin: 0">'.$fname.' '.$lname.'<br>'.$address1.'<br>'.$city.' '.$province.' '.$zip.'<br>'.$country.'</p>
                     </td>
                  </tr>
				  <tr style="border-bottom:1px solid #e5e5e5;"><td colspan="2">&nbsp;</td></tr>
				  <tr>
                     <td colspan="2" style="font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Roboto&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; width: 50%">
                        <p style="color: #777; line-height: 150%; font-size: 13px; margin: 0">If you have any questions regarding your order or account, please email us at info@lifelet.co</p>
                     </td>
                  </tr>
               </tbody>
            </table>
            
         </td>
      </tr>
   </tbody>
</table>';
//echo $str;exit;
$discount_cent=str_replace('%','',$discount_cent);
$subject="LIFElet - Order #".$order_number_shopify;
$headers="MIME-Version: 1.0" . "\r\n";
$headers.="Content-type:text/html;charset=UTF-8"."\r\n";
// More headers
$headers.='From: <info@lifelet.co>'."\r\n";
//$headers.='Cc: myboss@example.com'."\r\n";
@mail($email,$subject,$str,$headers);