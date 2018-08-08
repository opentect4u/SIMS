<script>
    function printDiv() {
        var divToPrint=document.getElementById('divToPrint');

        var WindowObject=window.open('','Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title><style type="text/css">');


        WindowObject.document.writeln('@media print { .center { text-align: center;}' +
            '                                         .inline { display: inline; }' +
            '                                         .underline { text-decoration: underline; }' +
            '                                         .left { margin-left: 315px;} ' +
            '                                         .right { margin-right: 375px; display: inline; }' +
            '                                          table, th, td { border: 1px solid black; border-collapse: collapse; }' +
            '                                           th, td { padding: 5px; }' +
            '                                         .border { border: 1px solid black; } ' +
            '                                         .bottom { bottom: 5px; width: 100%; ' +
            '                                       ' +
            '                                   } } </style>');
        // WindowObject.document.writeln('<style type="text/css">@media print{p { color: blue; }}');
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        setTimeout(function(){ WindowObject.close();},10);

    }
</script>


    <div id="divToPrint">

        <div>

            <h3 class="underline" style="margin-left: 40%">

                Original

            </h3>

            <p class="inline">

                Serial No.-

            </p>

            <p class="center inline" style="margin-left: 25%">

                Challan / Cash Memo

            </p>

            <p class="inline" style="margin-left: 21%">

                Date ..............................

            </p>

        </div>

        <div>

            <h1 class="center">

                Distributor Name - Laxmi Narayan Stores

            </h1>

            <h3 class="center">

                Belegram, Thana - Udaynarayanpur, District - Howrah

            </h3>

        </div>

        <div>

            <p class="inline">

                Distributor No.-

            </p>

            <p class="inline" style="margin-left: 58%">

                Car No.- ..............................

            </p>

        </div>

        <br style="line-height: 15px;">

        <div>

            <p class="inline">

                S.C.F & S Order No. ..............................

            </p>

            <p class="inline" style="margin-left: 39.5%">

                Date ..............................

            </p>

        </div>

        <br style="line-height: 15px;">

        <div>

            <p class="inline">

                Dealer's Name ..................................................................................................................................................

            </p>

        </div>

        <br style="line-height: 15px;">

        <div>

            <p class="inline">

                Address ..................................................................................

            </p>

            <p class="inline" style="margin-left: 5%">

                Region ............................................

            </p>

        </div>

        <br style="line-height: 15px;">

        <div>

            <p class="inline">

                District ..................................................................................

            </p>

            <p class="inline" style="margin-left: 5%">

                Dealer No. / Code ..............................

            </p>

        </div>

        <br style="line-height: 15px;">

        <div>

            <table style="width: 100%;">

                <thead style="text-align: center;" >

                    <tr>

                        <th width="5%">Category</th>

                        <th>Substance</th>

                        <th>Quantity</th>

                        <th>Worth</th>

                        <th>Price</th>

                    </tr>

                </thead>

                <tbody style="text-align: right;" >

                    <tr>

                        <td rowspan="4" style="text-align: center;">AAY</td>

                        <td style="text-align: center;">Rice</td>

                        <td>7.88</td>

                        <td>146</td>

                        <td>1150</td>

                    </tr>

                    <tr>

                        <td style="text-align: center;">Wheat</td>

                        <td>7.88</td>

                        <td>146</td>

                        <td>1150</td>

                    </tr>

                    <tr>

                        <td style="text-align: center;">Atta</td>

                        <td>7.88</td>

                        <td>146</td>

                        <td>1150</td>

                    </tr>

                    <tr>

                        <td style="text-align: center;">Sugar</td>

                        <td>7.88</td>

                        <td>146</td>

                        <td>1150</td>

                    </tr>



                    <tr>

                        <td rowspan="3" style="text-align: center;">PHH</td>

                        <td style="text-align: center;">Rice</td>

                        <td>7.88</td>

                        <td>146</td>

                        <td>1150</td>

                    </tr>

                    <tr>

                        <td style="text-align: center;">Wheat</td>

                        <td>7.88</td>

                        <td>146</td>

                        <td>1150</td>

                    </tr>

                    <tr>

                        <td style="text-align: center;">Atta</td>

                        <td>7.88</td>

                        <td>146</td>

                        <td>1150</td>

                    </tr>



                    <tr>

                        <td rowspan="4" style="text-align: center;">SPHH</td>

                        <td style="text-align: center;">Rice</td>

                        <td>7.88</td>

                        <td>146</td>

                        <td>1150</td>

                    </tr>

                    <tr>

                        <td style="text-align: center;">Wheat</td>

                        <td>7.88</td>

                        <td>146</td>

                        <td>1150</td>

                    </tr>

                    <tr>

                        <td style="text-align: center;">Atta</td>

                        <td>7.88</td>

                        <td>146</td>

                        <td>1150</td>

                    </tr>

                    <tr>

                        <td style="text-align: center;">Sugar</td>

                        <td>7.88</td>

                        <td>146</td>

                        <td>1150</td>

                    </tr>



                    <tr>

                        <td rowspan="3" style="text-align: center;">RKSY-I</td>

                        <td style="text-align: center;">Rice</td>

                        <td>7.88</td>

                        <td>146</td>

                        <td>1150</td>

                    </tr>

                    <tr>

                        <td style="text-align: center;">Wheat</td>

                        <td>7.88</td>

                        <td>146</td>

                        <td>1150</td>

                    </tr>

                    <tr>

                        <td style="text-align: center;">Atta</td>

                        <td>7.88</td>

                        <td>146</td>

                        <td>1150</td>

                    </tr>


                    <tr>

                        <td rowspan="3" style="text-align: center;">RKSY-II</td>

                        <td style="text-align: center;">Rice</td>

                        <td>7.88</td>

                        <td>146</td>

                        <td>1150</td>

                    </tr>

                    <tr>

                        <td style="text-align: center;">Wheat</td>

                        <td>7.88</td>

                        <td>146</td>

                        <td>1150</td>

                    </tr>

                    <tr>

                        <td style="text-align: center;">Atta</td>

                        <td>7.88</td>

                        <td>146</td>

                        <td>1150</td>

                    </tr>



                    <tr>

                        <td rowspan="2" style="text-align: center;">ADDI</td>

                        <td style="text-align: center;">AAY</td>

                        <td>7.88</td>

                        <td>146</td>

                        <td>1150</td>

                    </tr>

                    <tr>

                        <td style="text-align: center;">APL & BPL</td>

                        <td></td>

                        <td></td>

                        <td></td>

                    </tr>



                    <tr>

                        <td colspan="4" style="text-align: center;">Total</td>

                        <td></td>

                    </tr>

                </tbody>

            </table>

        </div>

        <br style="line-height: 50px;">

        <div class="bottom">

            <div style="margin-left: 5%">

                <p class="center inline">-------------------------------</p>

                <p class="center inline" style="margin-left: 43%">-------------------------------</p>

            </div>

            <div style="margin-left: 8%">

                <p class="center inline">Dealer's Signature</p>

                <p class="center inline" style="margin-left: 50%">Distributor's Signature</p>

            </div>


        </div>

    </div>

<div class="modal-footer">

    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

    <button class="btn btn-secondary" type="button" onclick="printDiv();">Print</button>

</div>

