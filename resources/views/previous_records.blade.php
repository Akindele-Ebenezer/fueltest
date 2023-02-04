@extends('layouts.layout_1')
 
@section('name', $name)
@section('email', $email)
@section('header_info', $title)
@section('title', $title)
@section('content')
        <section class="show-record edit-this-record hide">
            <section class="show-record-side-bar fuel-test-main"> 
                <div>
                    <span class="CancelRecordModal">&#10006;</span> 
                </div> 
                <br><br>
                <em class="SampleNo_"></em>
                @include('DATA.EditUpdateData')
                <hr><br>
                <center class="VendorName_"></center>
                <center class="VendorNo_"></center>
                 <br>
                <h2>MADE BY:</h2>
                <span class="MadeBy_"></span> 
                <br><br>
                <div class="record-info">
                    <p>You are editing the RECORD with the SAMPLE NO. <em class="SampleNo_"></em>. 
                        Make appropriate changes, then click UPDATE RECORD Button below to save changes.
                        <br><br>
                        NB: Don't try to change or edit Sample No for a Record as no changes will be made, and such Record will not be identified.<br>
                        You are to modify any other fields you want, not the Sample No. 
                    </p>
                    <br><br>
                    <ul>
                        <li> <a href="/FuelTest">Insert New Record.</a> </li>
                        <li> <center class="CancelRecordModal cursor"> Edit Previous Records.</center> </li>
                    </ul>
                </div>  
                <div class="form">
                    <form class="UpdateMyRecord">
                        <div class="edit-vendor-details">  
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M352 128C352 198.7 294.7 256 224 256C153.3 256 96 198.7 96 128C96 57.31 153.3 0 224 0C294.7 0 352 57.31 352 128zM209.1 359.2L176 304H272L238.9 359.2L272.2 483.1L311.7 321.9C388.9 333.9 448 400.7 448 481.3C448 498.2 434.2 512 417.3 512H30.72C13.75 512 0 498.2 0 481.3C0 400.7 59.09 333.9 136.3 321.9L175.8 483.1L209.1 359.2z"/></svg>
                            <label for="VendorNo">Vendor No.</label><br>
                            <input class="select EditVendorNo" type="text" placeholder="Vendor No..." name="VendorNo"  autocomplete="off">
                            <section class="VendorList">
                                <ul>
                                    <h2><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M352 128C352 198.7 294.7 256 224 256C153.3 256 96 198.7 96 128C96 57.31 153.3 0 224 0C294.7 0 352 57.31 352 128zM209.1 359.2L176 304H272L238.9 359.2L272.2 483.1L311.7 321.9C388.9 333.9 448 400.7 448 481.3C448 498.2 434.2 512 417.3 512H30.72C13.75 512 0 498.2 0 481.3C0 400.7 59.09 333.9 136.3 321.9L175.8 483.1L209.1 359.2z"/></svg>VENDORS List <span></span></h2>
                                    @foreach($vendors as $vendor)
                                        <li class="dropdown-list"><p>{{ $vendor->VendorName }}</p> <span>{{ $vendor->VendorNo }}</span></li> 
                                    @endforeach
                                </ul>
                            </section>
                            <input type="text" class="EditVendorName" placeholder="Name of VENDOR..." name="VendorName" > 
                        </div> 
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M55.1 56.04C55.1 42.78 66.74 32.04 79.1 32.04H111.1C125.3 32.04 135.1 42.78 135.1 56.04V176H151.1C165.3 176 175.1 186.8 175.1 200C175.1 213.3 165.3 224 151.1 224H71.1C58.74 224 47.1 213.3 47.1 200C47.1 186.8 58.74 176 71.1 176H87.1V80.04H79.1C66.74 80.04 55.1 69.29 55.1 56.04V56.04zM118.7 341.2C112.1 333.8 100.4 334.3 94.65 342.4L83.53 357.9C75.83 368.7 60.84 371.2 50.05 363.5C39.26 355.8 36.77 340.8 44.47 330.1L55.59 314.5C79.33 281.2 127.9 278.8 154.8 309.6C176.1 333.1 175.6 370.5 153.7 394.3L118.8 432H152C165.3 432 176 442.7 176 456C176 469.3 165.3 480 152 480H64C54.47 480 45.84 474.4 42.02 465.6C38.19 456.9 39.9 446.7 46.36 439.7L118.4 361.7C123.7 355.9 123.8 347.1 118.7 341.2L118.7 341.2zM512 64C529.7 64 544 78.33 544 96C544 113.7 529.7 128 512 128H256C238.3 128 224 113.7 224 96C224 78.33 238.3 64 256 64H512zM512 224C529.7 224 544 238.3 544 256C544 273.7 529.7 288 512 288H256C238.3 288 224 273.7 224 256C224 238.3 238.3 224 256 224H512zM512 384C529.7 384 544 398.3 544 416C544 433.7 529.7 448 512 448H256C238.3 448 224 433.7 224 416C224 398.3 238.3 384 256 384H512z"/></svg>
                            <label for="SampleNo.">Sample No.</label><br>
                            <input name="SampleNo" type="text" class="EditSampleNo" >
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M160 32V64H288V32C288 14.33 302.3 0 320 0C337.7 0 352 14.33 352 32V64H400C426.5 64 448 85.49 448 112V160H0V112C0 85.49 21.49 64 48 64H96V32C96 14.33 110.3 0 128 0C145.7 0 160 14.33 160 32zM0 192H448V464C448 490.5 426.5 512 400 512H48C21.49 512 0 490.5 0 464V192zM328.1 304.1C338.3 295.6 338.3 280.4 328.1 271C319.6 261.7 304.4 261.7 295 271L200 366.1L152.1 319C143.6 309.7 128.4 309.7 119 319C109.7 328.4 109.7 343.6 119 352.1L183 416.1C192.4 426.3 207.6 426.3 216.1 416.1L328.1 304.1z"/></svg>
                            <label for="SampleCollectionDate">Sample Collection Date</label><br>
                            <input name="SampleCollectionDate" type="date" class="EditSampleCollectionDate" > 
                        </div>
                        <input name="uid" type="hidden" value="{{ $id }}" >
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M368 0C394.5 0 416 21.49 416 48V96H466.7C483.7 96 499.1 102.7 512 114.7L589.3 192C601.3 204 608 220.3 608 237.3V352C625.7 352 640 366.3 640 384C640 401.7 625.7 416 608 416H576C576 469 533 512 480 512C426.1 512 384 469 384 416H256C256 469 213 512 160 512C106.1 512 64 469 64 416H48C21.49 416 0 394.5 0 368V48C0 21.49 21.49 0 48 0H368zM416 160V256H544V237.3L466.7 160H416zM160 368C133.5 368 112 389.5 112 416C112 442.5 133.5 464 160 464C186.5 464 208 442.5 208 416C208 389.5 186.5 368 160 368zM480 464C506.5 464 528 442.5 528 416C528 389.5 506.5 368 480 368C453.5 368 432 389.5 432 416C432 442.5 453.5 464 480 464z"/></svg>
                            <label for="TruckPlateNo">Truck Plate No.</label><br>
                            <input name="TruckPlateNo" type="text" class="EditTruckPlateNo" placeholder="Enter Plate No." >
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M320 32C343.7 32 364.4 44.87 375.4 64H427.2C452.5 64 475.4 78.9 485.7 102L538.5 220.8C538.1 221.9 539.4 222.9 539.8 224H544C579.3 224 608 252.7 608 288V320C625.7 320 640 334.3 640 352C640 369.7 625.7 384 608 384H576C576 437 533 480 480 480C426.1 480 384 437 384 384H256C256 437 213 480 160 480C106.1 480 64 437 64 384H32C14.33 384 0 369.7 0 352C0 334.3 14.33 320 32 320V288C14.33 288 0 273.7 0 256V160C0 142.3 14.33 128 32 128V96C32 60.65 60.65 32 96 32L320 32zM384 128V224H469.9L427.2 128H384zM160 336C133.5 336 112 357.5 112 384C112 410.5 133.5 432 160 432C186.5 432 208 410.5 208 384C208 357.5 186.5 336 160 336zM480 432C506.5 432 528 410.5 528 384C528 357.5 506.5 336 480 336C453.5 336 432 357.5 432 384C432 410.5 453.5 432 480 432zM253.3 135.1C249.4 129.3 242.1 126.6 235.4 128.7C228.6 130.7 224 136.9 224 144V240C224 248.8 231.2 256 240 256C248.8 256 256 248.8 256 240V196.8L290.7 248.9C294.6 254.7 301.9 257.4 308.6 255.3C315.4 253.3 320 247.1 320 240V144C320 135.2 312.8 128 304 128C295.2 128 288 135.2 288 144V187.2L253.3 135.1zM128 144C128 135.2 120.8 128 112 128C103.2 128 96 135.2 96 144V208C96 234.5 117.5 256 144 256C170.5 256 192 234.5 192 208V144C192 135.2 184.8 128 176 128C167.2 128 160 135.2 160 144V208C160 216.8 152.8 224 144 224C135.2 224 128 216.8 128 208V144z"/></svg>
                            <label for="TankNo">Tank No.</label><br>
                            <input name="TankNo" type="text" class="EditTankNo" placeholder="Input Plate No." >
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M96.2 200.1C96.07 197.4 96 194.7 96 192C96 103.6 167.6 32 256 32C315.3 32 367 64.25 394.7 112.2C409.9 101.1 428.3 96 448 96C501 96 544 138.1 544 192C544 204.2 541.7 215.8 537.6 226.6C596 238.4 640 290.1 640 352C640 422.7 582.7 480 512 480H144C64.47 480 0 415.5 0 336C0 273.2 40.17 219.8 96.2 200.1z"/></svg>
                            <label for="AppearanceResult">Appearance Result</label><br>  
                            <input type="text" class="EditAppearanceResult" class="appearance-result select"  name="AppearanceResult" readonly>                 
                            <section class="AppearanceResult">
                                <ul>
                                    <h2><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M96.2 200.1C96.07 197.4 96 194.7 96 192C96 103.6 167.6 32 256 32C315.3 32 367 64.25 394.7 112.2C409.9 101.1 428.3 96 448 96C501 96 544 138.1 544 192C544 204.2 541.7 215.8 537.6 226.6C596 238.4 640 290.1 640 352C640 422.7 582.7 480 512 480H144C64.47 480 0 415.5 0 336C0 273.2 40.17 219.8 96.2 200.1z"/></svg>APPEARANCE Result <span> </span></h2>
                                    <li class="Bright dropdown-list"><span></span> BRIGHT</li>
                                    <li class="Clear dropdown-list"><span></span> CLEAR</li>
                                    <li class="Muddy dropdown-list"><span></span> MUDDY</li> 
                                </ul>
                            </section> 
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M512 255.1C512 256.9 511.1 257.8 511.1 258.7C511.6 295.2 478.4 319.1 441.9 319.1H344C317.5 319.1 296 341.5 296 368C296 371.4 296.4 374.7 297 377.9C299.2 388.1 303.5 397.1 307.9 407.8C313.9 421.6 320 435.3 320 449.8C320 481.7 298.4 510.5 266.6 511.8C263.1 511.9 259.5 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256V255.1zM96 255.1C78.33 255.1 64 270.3 64 287.1C64 305.7 78.33 319.1 96 319.1C113.7 319.1 128 305.7 128 287.1C128 270.3 113.7 255.1 96 255.1zM128 191.1C145.7 191.1 160 177.7 160 159.1C160 142.3 145.7 127.1 128 127.1C110.3 127.1 96 142.3 96 159.1C96 177.7 110.3 191.1 128 191.1zM256 63.1C238.3 63.1 224 78.33 224 95.1C224 113.7 238.3 127.1 256 127.1C273.7 127.1 288 113.7 288 95.1C288 78.33 273.7 63.1 256 63.1zM384 191.1C401.7 191.1 416 177.7 416 159.1C416 142.3 401.7 127.1 384 127.1C366.3 127.1 352 142.3 352 159.1C352 177.7 366.3 191.1 384 191.1z"/></svg>
                            <label for="Color">Color</label><br>
                            <input type="text" class="choose-color select EditColor"  name="Color" readonly>                 
                            <section class="Colors">
                                <ul>
                                    <h2><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M512 255.1C512 256.9 511.1 257.8 511.1 258.7C511.6 295.2 478.4 319.1 441.9 319.1H344C317.5 319.1 296 341.5 296 368C296 371.4 296.4 374.7 297 377.9C299.2 388.1 303.5 397.1 307.9 407.8C313.9 421.6 320 435.3 320 449.8C320 481.7 298.4 510.5 266.6 511.8C263.1 511.9 259.5 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256V255.1zM96 255.1C78.33 255.1 64 270.3 64 287.1C64 305.7 78.33 319.1 96 319.1C113.7 319.1 128 305.7 128 287.1C128 270.3 113.7 255.1 96 255.1zM128 191.1C145.7 191.1 160 177.7 160 159.1C160 142.3 145.7 127.1 128 127.1C110.3 127.1 96 142.3 96 159.1C96 177.7 110.3 191.1 128 191.1zM256 63.1C238.3 63.1 224 78.33 224 95.1C224 113.7 238.3 127.1 256 127.1C273.7 127.1 288 113.7 288 95.1C288 78.33 273.7 63.1 256 63.1zM384 191.1C401.7 191.1 416 177.7 416 159.1C416 142.3 401.7 127.1 384 127.1C366.3 127.1 352 142.3 352 159.1C352 177.7 366.3 191.1 384 191.1z"/></svg>COLORS Palette <span> </span></h2>
                                    <li class="dropdown-list">0.5</li>
                                    <li class="dropdown-list">1.0</li>
                                    <li class="dropdown-list">1.5</li>
                                    <li class="dropdown-list">2.0</li>
                                    <li class="dropdown-list">2.5</li>
                                    <li class="dropdown-list">3.0</li>
                                    <li class="dropdown-list">3.5</li>
                                    <li class="dropdown-list">4.0</li>
                                    <li class="dropdown-list">4.5</li>
                                    <li class="dropdown-list">5.0</li>
                                    <li class="dropdown-list">5.5</li>
                                    <li class="dropdown-list">6.0</li>
                                    <li class="dropdown-list">6.5</li>
                                    <li class="dropdown-list">7.0</li>
                                    <li class="dropdown-list">7.5</li>
                                    <li class="dropdown-list">8.0</li> 
                                </ul>
                            </section>  
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M85 250.5c-87 174.2-84.1 165.9-84.1 181.5C.0035 476.1 57.25 512 128 512s128-35.88 128-79.1c0-16.12 1.375-8.752-85.12-181.5C153.3 215.3 102.8 215.1 85 250.5zM55.96 416l71.98-143.1l72.15 143.1H55.96zM554.9 122.5c-17.62-35.25-68.08-35.37-85.83 0c-87 174.2-85.04 165.9-85.04 181.5c0 44.12 57.25 79.1 128 79.1s127.1-35.87 127.1-79.1C639.1 287.9 641.4 295.3 554.9 122.5zM439.1 288l72.04-143.1l72.08 143.1H439.1zM495.1 448h-143.1V153.3c20.83-9.117 36.72-26.93 43.78-48.77l126.3-42.11c16.77-5.594 25.83-23.72 20.23-40.48c-5.578-16.73-23.62-25.86-40.48-20.23l-113.3 37.76c-13.94-23.49-39.29-39.41-68.58-39.41c-44.18 0-79.1 35.82-79.1 80c0 2.961 .5587 5.771 .8712 8.648L117.9 129.7C101.1 135.3 92.05 153.4 97.64 170.1c4.469 13.41 16.95 21.88 30.36 21.88c3.344 0 6.768-.5186 10.13-1.644L273.8 145.1C278.2 148.3 282.1 151.1 288 153.3V496C288 504.8 295.2 512 304 512h223.1c8.838 0 16-7.164 16-15.1C543.1 469.5 522.5 448 495.1 448z"/></svg>
                            <label for="Density">Density in Kg/m<sup>3</sup></label><br>
                            <input name="Density" type="text" class="EditDensity" placeholder="Input Density..." >
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M96 32C96 14.33 110.3 0 128 0H192C209.7 0 224 14.33 224 32V128H96V32zM224 160C277 160 320 202.1 320 256V464C320 490.5 298.5 512 272 512H48C21.49 512 0 490.5 0 464V256C0 202.1 42.98 160 96 160H224zM160 416C204.2 416 240 380.2 240 336C240 291.8 204.2 256 160 256C115.8 256 80 291.8 80 336C80 380.2 115.8 416 160 416zM384 48C384 49.36 383 50.97 381.8 51.58L352 64L339.6 93.78C338.1 95 337.4 96 336 96C334.6 96 333 95 332.4 93.78L320 64L290.2 51.58C288.1 50.97 288 49.36 288 48C288 46.62 288.1 45.03 290.2 44.42L320 32L332.4 2.219C333 1 334.6 0 336 0C337.4 0 338.1 1 339.6 2.219L352 32L381.8 44.42C383 45.03 384 46.62 384 48zM460.4 93.78L448 64L418.2 51.58C416.1 50.97 416 49.36 416 48C416 46.62 416.1 45.03 418.2 44.42L448 32L460.4 2.219C461 1 462.6 0 464 0C465.4 0 466.1 1 467.6 2.219L480 32L509.8 44.42C511 45.03 512 46.62 512 48C512 49.36 511 50.97 509.8 51.58L480 64L467.6 93.78C466.1 95 465.4 96 464 96C462.6 96 461 95 460.4 93.78zM467.6 194.2L480 224L509.8 236.4C511 237 512 238.6 512 240C512 241.4 511 242.1 509.8 243.6L480 256L467.6 285.8C466.1 287 465.4 288 464 288C462.6 288 461 287 460.4 285.8L448 256L418.2 243.6C416.1 242.1 416 241.4 416 240C416 238.6 416.1 237 418.2 236.4L448 224L460.4 194.2C461 193 462.6 192 464 192C465.4 192 466.1 193 467.6 194.2zM448 144C448 145.4 447 146.1 445.8 147.6L416 160L403.6 189.8C402.1 191 401.4 192 400 192C398.6 192 397 191 396.4 189.8L384 160L354.2 147.6C352.1 146.1 352 145.4 352 144C352 142.6 352.1 141 354.2 140.4L384 128L396.4 98.22C397 97 398.6 96 400 96C401.4 96 402.1 97 403.6 98.22L416 128L445.8 140.4C447 141 448 142.6 448 144z"/></svg>
                            <label for="FlashPoint">Flash Point</label><br>
                            <input name="FlashPoint" type="text" class="EditFlashPoint" placeholder="Enter Flash Point..." >
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M160 322.9V112C160 103.3 152.8 96 144 96S128 103.3 128 112v210.9C109.4 329.5 96 347.1 96 368C96 394.5 117.5 416 144 416S192 394.5 192 368C192 347.1 178.6 329.5 160 322.9zM416 0c-52.88 0-96 43.13-96 96s43.13 96 96 96s96-43.13 96-96S468.9 0 416 0zM416 128c-17.75 0-32-14.25-32-32s14.25-32 32-32s32 14.25 32 32S433.8 128 416 128zM256 112c0-61.88-50.13-112-112-112s-112 50.13-112 112v166.5c-19.75 24.75-32 55.5-32 89.5c0 79.5 64.5 144 144 144s144-64.5 144-144c0-33.1-12.25-64.88-32-89.5V112zM144 448c-44.13 0-80-35.88-80-80c0-25.5 12.25-48.88 32-63.75v-192.3c0-26.5 21.5-48 48-48S192 85.5 192 112V304.3c19.75 14.75 32 38.25 32 63.75C224 412.1 188.1 448 144 448z"/></svg>
                            <label for="Temp">Temp °C</label><br>
                            <input name="Temp" type="text" class="EditTemp" placeholder="Temperature..." >
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M549.8 237.5c-31.23-5.719-46.84-20.06-47.13-20.31C490.4 205 470.3 205.1 457.7 216.8c-1 .9375-25.14 23-73.73 23s-72.73-22.06-73.38-22.62C298.4 204.9 278.3 205.1 265.7 216.8c-1 .9375-25.14 23-73.73 23S119.3 217.8 118.6 217.2C106.4 204.9 86.35 205 73.74 216.9C73.09 217.4 57.48 231.8 26.24 237.5c-17.38 3.188-28.89 19.84-25.72 37.22c3.188 17.38 19.78 29.09 37.25 25.72C63.1 295.8 82.49 287.1 95.96 279.2c19.5 11.53 51.47 24.68 96.04 24.68c44.55 0 76.49-13.12 96-24.65c19.52 11.53 51.45 24.59 96 24.59c44.58 0 76.55-13.09 96.05-24.62c13.47 7.938 32.86 16.62 58.19 21.25c17.56 3.375 34.06-8.344 37.25-25.72C578.7 257.4 567.2 240.7 549.8 237.5zM549.8 381.7c-31.23-5.719-46.84-20.06-47.13-20.31c-12.22-12.19-32.31-12.12-44.91-.375C456.7 361.9 432.6 384 384 384s-72.73-22.06-73.38-22.62c-12.22-12.25-32.3-12.12-44.89-.375C264.7 361.9 240.6 384 192 384s-72.73-22.06-73.38-22.62c-12.22-12.25-32.28-12.16-44.89-.3438c-.6562 .5938-16.27 14.94-47.5 20.66c-17.38 3.188-28.89 19.84-25.72 37.22C3.713 436.3 20.31 448 37.78 444.6C63.1 440 82.49 431.3 95.96 423.4c19.5 11.53 51.51 24.62 96.08 24.62c44.55 0 76.45-13.06 95.96-24.59C307.5 434.9 339.5 448 384.1 448c44.58 0 76.5-13.09 95.1-24.62c13.47 7.938 32.86 16.62 58.19 21.25C555.8 448 572.3 436.3 575.5 418.9C578.7 401.5 567.2 384.9 549.8 381.7zM37.78 156.4c25.33-4.625 44.72-13.31 58.19-21.25c19.5 11.53 51.47 24.68 96.04 24.68c44.55 0 76.49-13.12 96-24.65c19.52 11.53 51.45 24.59 96 24.59c44.58 0 76.55-13.09 96.05-24.62c13.47 7.938 32.86 16.62 58.19 21.25c17.56 3.375 34.06-8.344 37.25-25.72c3.172-17.38-8.344-34.03-25.72-37.22c-31.23-5.719-46.84-20.06-47.13-20.31c-12.22-12.19-32.31-12.12-44.91-.375c-1 .9375-25.14 23-73.73 23s-72.73-22.06-73.38-22.62c-12.22-12.25-32.3-12.12-44.89-.375c-1 .9375-25.14 23-73.73 23S119.3 73.76 118.6 73.2C106.4 60.95 86.35 61.04 73.74 72.85C73.09 73.45 57.48 87.79 26.24 93.51c-17.38 3.188-28.89 19.84-25.72 37.22C3.713 148.1 20.31 159.8 37.78 156.4z"/></svg>
                            <label for="WaterSediment">Water/Sediment % </label><br>
                            <input name="WaterSediment" type="text" class="EditWaterSediment" placeholder="Required..." >
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M320 256c35.35 0 64-28.65 64-64c0-35.35-28.65-64-64-64s-64 28.65-64 64C256 227.3 284.7 256 320 256zM160 288c-35.35 0-64 28.65-64 64c0 35.35 28.65 64 64 64h192c35.35 0 64-28.65 64-64c0-35.35-28.65-64-64-64H160zM384 64c17.67 0 32-14.33 32-32c0-17.67-14.33-32-32-32s-32 14.33-32 32C352 49.67 366.3 64 384 64zM208 96C234.5 96 256 74.51 256 48S234.5 0 208 0S160 21.49 160 48S181.5 96 208 96zM416 192c0 27.82-12.02 52.68-30.94 70.21C421.7 275.7 448 310.7 448 352c0 53.02-42.98 96-96 96H160c-53.02 0-96-42.98-96-96s42.98-96 96-96h88.91C233.6 238.1 224 216.7 224 192H96C42.98 192 0 234.1 0 288v128c0 53.02 42.98 96 96 96h320c53.02 0 96-42.98 96-96V288C512 234.1 469 192 416 192z"/></svg>
                            <label for="Cleanliness">Cleanliness</label><br>
                            <input name="Cleanliness" type="text" class="EditCleanliness" placeholder="Cleanliness..." >
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M160 32V64H288V32C288 14.33 302.3 0 320 0C337.7 0 352 14.33 352 32V64H400C426.5 64 448 85.49 448 112V160H0V112C0 85.49 21.49 64 48 64H96V32C96 14.33 110.3 0 128 0C145.7 0 160 14.33 160 32zM0 192H448V464C448 490.5 426.5 512 400 512H48C21.49 512 0 490.5 0 464V192zM80 256C71.16 256 64 263.2 64 272V368C64 376.8 71.16 384 80 384H176C184.8 384 192 376.8 192 368V272C192 263.2 184.8 256 176 256H80z"/></svg>
                            <label for="DateOfTest">Date Of Test</label><br>
                            <input name="DateOfTest" type="date" class="EditSampleCollectionDate" >
                        </div> 
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"/></svg>
                            <label for="MadeBy">Made By (Name)</label><br>
                            <input type="text" class="made-by select EditMadeBy" name="MadeBy" readonly>                 
                            <section class="MadeBy">
                                <ul>
                                    <h2><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"/></svg>Made By <span>(Name)</span></h2>
                                    @foreach($fuel_test_users as $fuel_test_user)
                                        <li class="dropdown-list">{{ $fuel_test_user->Name }}</li>  
                                    @endforeach
                                </ul>
                            </section>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M274.7 304H173.3C77.61 304 0 381.6 0 477.3C0 496.5 15.52 512 34.66 512H413.3C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304zM224 256c70.7 0 128-57.31 128-128S294.7 0 224 0C153.3 0 96 57.31 96 128S153.3 256 224 256zM632.3 134.4c-9.703-9-24.91-8.453-33.92 1.266l-87.05 93.75l-38.39-38.39c-9.375-9.375-24.56-9.375-33.94 0s-9.375 24.56 0 33.94l56 56C499.5 285.5 505.6 288 512 288h.4375c6.531-.125 12.72-2.891 17.16-7.672l104-112C642.6 158.6 642 143.4 632.3 134.4z"/></svg>
                            <label for="DeliveredTo">Delivered To</label><br>
                            <input name="DeliveredTo" class="EditDeliveredTo" type="text" placeholder="Delivered To..." >
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M96.2 200.1C96.07 197.4 96 194.7 96 192C96 103.6 167.6 32 256 32C315.3 32 367 64.25 394.7 112.2C409.9 101.1 428.3 96 448 96C501 96 544 138.1 544 192C544 204.2 541.7 215.8 537.6 226.6C596 238.4 640 290.1 640 352C640 422.7 582.7 480 512 480H144C64.47 480 0 415.5 0 336C0 273.2 40.17 219.8 96.2 200.1z"/></svg>                     
                            <label for="ApprovalForUse">Approval For Use</label><br>  
                            <input type="text" class="approval-for-use select EditApprovalForUse"  name="ApprovalForUse" readonly>                 
                            <section class="ApprovalForUse">
                                <ul>
                                    <h2><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M96.2 200.1C96.07 197.4 96 194.7 96 192C96 103.6 167.6 32 256 32C315.3 32 367 64.25 394.7 112.2C409.9 101.1 428.3 96 448 96C501 96 544 138.1 544 192C544 204.2 541.7 215.8 537.6 226.6C596 238.4 640 290.1 640 352C640 422.7 582.7 480 512 480H144C64.47 480 0 415.5 0 336C0 273.2 40.17 219.8 96.2 200.1z"/></svg>Test Approval<span> </span></h2>
                                    <li class="Rejected dropdown-list">REJECTED</li>
                                    <li class="Approved dropdown-list">APPROVED</li>
                                    <li class="Waved dropdown-list">WAIVED</li> 
                                </ul>
                            </section> 
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L440.6 201.4L310.6 71.43L362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75zM240.1 114.9C231.6 105.5 216.4 105.5 207 114.9L104.1 216.1C95.6 226.3 80.4 226.3 71.03 216.1C61.66 207.6 61.66 192.4 71.03 183L173.1 80.97C201.2 52.85 246.8 52.85 274.9 80.97L417.9 224L229.5 412.5C181.5 460.5 120.3 493.2 53.7 506.5L28.71 511.5C20.84 513.1 12.7 510.6 7.03 504.1C1.356 499.3-1.107 491.2 .4662 483.3L5.465 458.3C18.78 391.7 51.52 330.5 99.54 282.5L254.1 128L240.1 114.9z"/></svg>
                            <label for="Remarks">Remarks</label><br>
                            <input name="Remarks" class="EditRemarks" type="text" placeholder="Remarks..." >
                        </div>
                        <div>
                            <center><button name='Edit' type="submit">UPDATE RECORD</button></center>
                        </div>
                    </form>
                </div>
            </section>
        </section>
        <script src="/JS/Scripts.js"></script>
    @include('ShowRecord')
    <section class="previous-records">
        @include('PageTitleForRecords')        
        <div class="table">
            <form class="DeleteRecords_" action="">
            <table>
                <tr>
                    <th class="resizable">Days/Weeks/Months </th>
                    <th class="resizable">Sample No. 
                        <label>
                            <input type="submit" name="SortBySampleNo" class="hide">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    <svg class="filter-sample-no-svg" class="filter-sample-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <h1>Sample Numbers</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterSampleNo">Filter</button>
                                </center>
                                @foreach($FilterSampleNo as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckSampleNo[]" value="{{ $filter->SampleNo }}"> {{ $filter->SampleNo }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">
                        Action
                    </th>
                    <th class="vendors-th resizable">Vendors 
                        <label>
                            <input type="submit" name="SortByVendorName" class="hide">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    <svg class="filter-remarks-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <h1>Vendor Catalogue</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterVendorName">Filter</button>
                                </center>
                                @foreach($FilterVendorName as $filter) 
                                    @if ($filter->VendorName === NULL)
                                        @continue
                                    @endif
                                    <li>
                                        <input type="checkbox" name="CheckVendorName[]" value="{{ $filter->VendorName }}"> {{ $filter->VendorName }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Sample Collection Date 
                        <label>
                            <input type="submit" name="SortBySampleCollectionDate" class="hide">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    <svg class="filter-sample-collection-date-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-collection-date">
                        <ul>
                            <form action="" method="get">
                                <br> 
                                <p>Select Fields</p> <br>
                                <span><center>Select range to genaerate your Fuel Test Report.</center></span>
                                <section>
                                    <li class="date"><span>From</span> <input type="date" name="DateFrom"> </li>
                                    <li class="date"><span>To</span> <input type="date" name="DateTo"> </li>
                                    <input type="hidden" name="Title" value="{{ $title }}">
                                    <button name="{{ isset($_GET['CheckVendorName']) || isset($_GET['FilterPassedTestsForCurrentVendor']) || isset($_GET['FilterDiffTestsForCurrentVendor']) || isset($_GET['FilterWavedTestsForCurrentVendor']) || isset($_GET['FilterFailedTestsForCurrentVendor']) ? 'FilterDateBetweenForCurrentVendor' : 'FilterDateBetween' }}">Generate Report</button>
                                </section> <br>
                                <section class="DatesFilter"> 
                                    <input type="hidden" name="RecordsOfToday" value="{{ date('Y-m-d') }}">
                                    <button name="FilterRecordsOfToday">Today</button>
                                </section>
                                <section class="DatesFilter"> 
                                    <input type="hidden" name="RecordsOfYesterday" value="{{ date('Y-m-d', strtotime( '-1 day' )) }}">
                                    <button name="FilterRecordsOfYesterday">Yesterday</button>
                                </section>
                                <section class="DatesFilter">  
                                    <button name="FilterRecordsOfLastSevenDays">Last Seven Days</button>
                                </section>
                                <section class="DatesFilter">  
                                    <button name="FilterRecordsOfThisMonth">This Month</button>
                                </section>
                                <section class="DatesFilter">  
                                    <button name="FilterRecordsOfLastMonth">Last Month</button>
                                </section> <br>
                                <h1>Collection Dates</h1> 
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterSampleCollectionDate">Filter</button>
                                </center>
                                @foreach($FilterSampleCollectionDate as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckSampleCollectionDate[]" value="{{ $filter->SampleCollectionDate }}"> {{ $filter->SampleCollectionDate }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Truck Plate No. 
                        <label>
                            <input type="submit" name="SortByTruckPlateNo" class="hide">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    <svg class="filter-truck-plate-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <h1>Truck Plate Numbers</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterTruckPlateNo">Filter</button>
                                </center>
                                @foreach($FilterTruckPlateNo as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckTruckPlateNo[]" value="{{ $filter->TruckPlateNo }}"> {{ $filter->TruckPlateNo }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Tank No. 
                        <label>
                            <input type="submit" name="SortByTankNo" class="hide">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    <svg class="filter-tank-no-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <h1>Tank Numbers</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterTankNo">Filter</button>
                                </center>
                                @foreach($FilterTankNo as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckTankNo[]" value="{{ $filter->TankNo }}"> {{ $filter->TankNo }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Appearance Result
                        <label>
                            <input type="submit" name="SortByAppearanceResult" class="hide">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    <svg class="filter-appearance-result-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <h1>Appearance Result</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterAppearanceResult">Filter</button>
                                </center>
                                @foreach($FilterAppearanceResult as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckAppearanceResult[]" value="{{ $filter->AppearanceResult }}"> {{ $filter->AppearanceResult }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Color
                        <label>
                            <input type="submit" name="SortByColor" class="hide">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    <svg class="filter-color-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <h1>Colors</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterColor">Filter</button>
                                </center>
                                @foreach($FilterColor as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckColor[]" value="{{ $filter->Color }}"> {{ $filter->Color }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Density in Kg/m<sup>3</sup>
                        <label>
                            <input type="submit" name="SortByDensity" class="hide">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    <svg class="filter-density-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <h1>Density</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterDensity">Filter</button>
                                </center>
                                @foreach($FilterDensity as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckDensity[]" value="{{ $filter->Density }}"> {{ $filter->Density }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Flash Point 
                        <label>
                            <input type="submit" name="SortByFlashPoint" class="hide">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    <svg class="filter-flash-point-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <h1>Flash Point</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterFlashPoint">Filter</button>
                                </center>
                                @foreach($FilterFlashPoint as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckFlashPoint[]" value="{{ $filter->FlashPoint }}"> {{ $filter->FlashPoint }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Temp °C
                        <label>
                            <input type="submit" name="SortByTemp" class="hide">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    <svg class="filter-temp-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <h1>Temperature</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterTemp">Filter</button>
                                </center>
                                @foreach($FilterTemp as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckTemp[]" value="{{ $filter->Temp }}"> {{ $filter->Temp }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Water/Sediment % 
                        <label>
                            <input type="submit" name="SortByWaterSediment" class="hide">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    <svg class="filter-water-sediment-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <h1>Water Sediment</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterWaterSediment">Filter</button>
                                </center>
                                @foreach($FilterWaterSediment as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckWaterSediment[]" value="{{ $filter->WaterSediment }}"> {{ $filter->WaterSediment }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Cleanliness
                        <label>
                            <input type="submit" name="SortByCleanliness" class="hide">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    <svg class="filter-cleanliness-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <h1>Cleanliness</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterCleanliness">Filter</button>
                                </center>
                                @foreach($FilterCleanliness as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckCleanliness[]" value="{{ $filter->Cleanliness }}"> {{ $filter->Cleanliness }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Date Of Test
                        <label>
                            <input type="submit" name="SortByDateOfTest" class="hide">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    <svg class="filter-date-of-test-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <h1>Date of Test</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterDateOfTest">Filter</button>
                                </center>
                                @foreach($FilterDateOfTest as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckDateOfTest[]" value="{{ $filter->DateOfTest }}"> {{ $filter->DateOfTest }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Made By (Name)
                        <label>
                            <input type="submit" name="SortByMadeBy" class="hide">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    <svg class="filter-made-by-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <h1>Made By</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterMadeBy">Filter</button>
                                </center>
                                @foreach($FilterMadeBy as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckMadeBy[]" value="{{ $filter->MadeBy }}"> {{ $filter->MadeBy }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Delivered To
                        <label>
                            <input type="submit" name="SortByDeliveredTo" class="hide">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    <svg class="filter-delivered-to-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <h1>Delivered To</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterDeliveredTo">Filter</button>
                                </center>
                                @foreach($FilterDeliveredTo as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckDeliveredTo[]" value="{{ $filter->DeliveredTo }}"> {{ $filter->DeliveredTo }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                    <th class="resizable">Remarks
                        <label>
                            <input type="submit" name="SortByRemarks" class="hide">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg>
                        </label>
                    <svg class="filter-remarks-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M3.853 54.87C10.47 40.9 24.54 32 40 32H472C487.5 32 501.5 40.9 508.1 54.87C514.8 68.84 512.7 85.37 502.1 97.33L320 320.9V448C320 460.1 313.2 471.2 302.3 476.6C291.5 482 278.5 480.9 268.8 473.6L204.8 425.6C196.7 419.6 192 410.1 192 400V320.9L9.042 97.33C-.745 85.37-2.765 68.84 3.854 54.87L3.853 54.87z"/></svg>
                    <div class="filter filter-sample-no">
                        <ul>
                            <form action="" method="get">
                                <h1>Remarks</h1>
                                <center>
                                    <button name="CancelFilter"><a href="{{ route('previous_records') }}">Cancel</a></button> <button name="FilterRemarks">Filter</button>
                                </center>
                                @foreach($FilterRemarks as $filter)
                                    <li>
                                        <input type="checkbox" name="CheckRemarks[]" value="{{ $filter->Remarks }}"> {{ $filter->Remarks }}
                                    </li>   
                                @endforeach
                            </form>
                        </ul>
                    </div></th>
                </tr>
                @if($number_of_previous_records == 0)
                <tr>
                    <td>
                         Your RECORD is currently empty.. 
                    </td>
                </tr>
                @endif
                @foreach($previous_records as $previous_record) 
                    @if($previous_record->SampleCollectionDate === date('Y-m-d', strtotime("-1 day")))
                        <tr class="Yesterday history">
                            <td>Yesterday <span></span> </td>  
                        </tr>
                    @elseif($previous_record->SampleCollectionDate === date('Y-m-d'))
                        <tr class="Today history">
                            <td>Today <span></span> </td>
                        </tr>
                    @elseif($previous_record->SampleCollectionDate === date('Y-m-d', strtotime("-2 day")))
                        <tr class="Two-Days-Ago history">
                            <td>Two days ago <span></span> </td>
                        </tr>
                    @elseif($previous_record->SampleCollectionDate === date('Y-m-d', strtotime("-3 day")))
                        <tr class="Three-Days-Ago history">
                            <td>Three days ago <span></span> </td>
                        </tr>
                    @elseif($previous_record->SampleCollectionDate === date('Y-m-d', strtotime("-4 day")))
                        <tr class="Four-Days-Ago history">
                            <td>Four days ago <span></span> </td>
                        </tr>
                    @elseif($previous_record->SampleCollectionDate === date('Y-m-d', strtotime("-5 day")))
                        <tr class="Five-Days-Ago history">
                            <td>Five days ago <span></span> </td>
                        </tr>
                    @elseif($previous_record->SampleCollectionDate === date('Y-m-d', strtotime("-6 day")))
                        <tr class="Six-Days-Ago history">
                            <td>Six days ago <span></span> </td>
                        </tr>
                    @elseif($previous_record->SampleCollectionDate >= date('Y-m-d', strtotime("-1 week")))
                        <tr class="Last-Week history">
                            <td>Last week  <span></span> </td>
                        </tr>
                    @elseif($previous_record->SampleCollectionDate >= date('Y-m-d', strtotime("-2 week")))
                        <tr class="Two-Weeks-Ago history">
                            <td>Two weeks ago    <span></span> </td>
                        </tr>
                    @elseif($previous_record->SampleCollectionDate >= date('Y-m-d', strtotime("-3 week")))
                        <tr class="Three-Weeks-Ago history">
                            <td>Three weeks ago <span></span> </td>
                        </tr>
                    @elseif($previous_record->SampleCollectionDate >= date('Y-m-d', strtotime("-1 month")))
                        <tr class="Last-Month history">
                            <td>Last month <span></span> </td>
                        </tr>
                    @elseif($previous_record->SampleCollectionDate >= date('Y-m-d', strtotime("-2 month")))
                        <tr class="Two-Months-Ago history">
                            <td>Two months ago <span></span> </td>
                        </tr>
                    @else($previous_record->SampleCollectionDate >= date('Y-m-d', strtotime("-2 month - 1 day")))
                        <tr class="Older history">
                            <td>Older  <span></span> </td>
                        </tr>
                    @endif   

                <tr class="rows">
                    <td class="pdf-and-edit">
                        <form action="/GenerateCertificate/{{ $previous_record->SampleNo }}" method="post" target="_blank">@csrf
                            <input type="image" src="/images/pdf.png"> 
                                    @include('DATA.CertificateData')
                        </form>  
                        <img class="EditIcon" src="/images/edit.png"> 
                        <form class="GenerateChart" action="{{ route('fuel_test_stats') }}" method="get">
                            <label>
                                <input class="hide" type="submit" src="/images/approved.png" name="GenerateChartForCurrentVendor" value="{{ $previous_record->VendorNo }}"> 
                                <img src="/images/chart.png">
                            </label>
                        </form>
                            @if($previous_record->ApprovalForUse === 'APPROVED')
                                <img src="images/approved.png"> <section class="records-tooltip tooltip">{{ $previous_record->SampleNo }} <br> [ Passed ]</section> 
                            @endif

                            @if($previous_record->ApprovalForUse === 'REJECTED')
                                <img src="images/rejected.png"> <section class="records-tooltip tooltip">{{ $previous_record->SampleNo }} <br> [ Rejected ]</section>  
                            @endif

                            @if($previous_record->ApprovalForUse === 'WAIVED')
                                <img src="images/waved.png"> <section class="records-tooltip tooltip">{{ $previous_record->SampleNo }} <br> [ Waived ]</section>  
                            @endif
                            
                            @if($previous_record->ApprovalForUse === NULL)
                                <img src="images/diff.png"> <section class="records-tooltip tooltip">{{ $previous_record->SampleNo }} <br> [ Diff ]</section>  
                            @endif
                            <section class="time">
                                ({{ empty($previous_record->created_at) ? '' : Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $previous_record->created_at)->format('H:i A') }})
                            </section>
                    </td>
                    @php
                        
                        $NumberOfTotalRecordsForEachVendor_ = App\Models\FuelTestRecord::select('id')
                                                                                        ->where('uid', $id) 
                                                                                        ->where('VendorName', $previous_record->VendorName) 
                                                                                        ->count(); 
                        
                    @endphp
                    <td class="sample-no">
                            <section class="records-tooltip tooltip">{{ $previous_record->SampleNo }} <br> <hr> Created at {{ empty($previous_record->created_at) ? '' : Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $previous_record->created_at)->format('H:i A') }}</section> 
                            <span class="SampleNumber">{{ $previous_record->SampleNo }}</span>  
                            <span class="hide">{{ $previous_record->VendorNo }}</span> 
                            <span class="hide">{{ $NumberOfTotalRecordsForEachVendor_ }}</span> 
                            <span class="hide">{{ $previous_record->ApprovalForUse }}</span> 
                        </td> 
                    </td>
                    <td class="action"> 
                        <input type="checkbox" name="DeleteRecord[]" value="{{ $previous_record->id }}">
                    </td>
                    <td class="vendors">
                        <span class='VendorName'>{{ $previous_record->VendorName }}</span>  
                        <section class="records-tooltip tooltip">
                            @include('SwitchCases.SwitchCasesForVendors') 
                        </section>
                    </td> 
                    <td class="sample-collection-date"><span class='SampleCollectionDate'>{{ $previous_record->SampleCollectionDate }} ({{ empty($previous_record->created_at) ? '' : Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $previous_record->created_at)->format('H:i A') }})</span></td> 
                    <td class="truck-plate-no"><span class='TruckPlateNo'>{{ $previous_record->TruckPlateNo  }}</span></td>
                    <td class="tank-no"><span class='TankNo'>{{ $previous_record->TankNo }}</span></td>
                    <td class="appearance-result"><p class="AppearanceResult {{ $previous_record->AppearanceResult === 'BRIGHT' ? 'Bright' : '' }}  {{ $previous_record->AppearanceResult === 'Bright' ? 'Bright' : '' }} {{ $previous_record->AppearanceResult === 'MUDDY' ? 'Muddy' : '' }}  {{ $previous_record->AppearanceResult === 'Muddy' ? 'Muddy' : '' }} {{ $previous_record->AppearanceResult === 'CLEAR' ? 'Clear' : '' }}  {{ $previous_record->AppearanceResult === 'Clear' ? 'Clear' : '' }} {{ $previous_record->AppearanceResult === 'C/M' ? 'CM' : '' }} Appearance">{{ $previous_record->AppearanceResult }} </p></td> 
                    <td><span class='Color'>{{ str_replace("Choose Color...", "null", $previous_record->Color) }}</span></td>
                    <td class="density"><span class='Density'>{{ $previous_record->Density }}</span></td>
                    <td class="flash-point"><span class='FlashPoint'>{{ $previous_record->FlashPoint }}</span></td>
                    <td class="temp"><span class='Temp'>{{ $previous_record->Temp }}</span></td>
                    <td><span class='WaterSediment'>{{ $previous_record->WaterSediment }} </span></td>
                    <td><span class='Cleanliness'>{{ $previous_record->Cleanliness }}</span></td>
                    <td><span class='DateOfTest'>{{ $previous_record->DateOfTest }}</span></td>
                    <td><span class='MadeBy'>{{ $previous_record->MadeBy }}</span></td>
                    <td><span class='DeliveredTo'>{{ $previous_record->DeliveredTo }}</span></td> 
                    <td class="remarks"><span class='Remarks'>{{ substr($previous_record->Remarks, 0, 17) }}{{ strlen($previous_record->Remarks) > 17 ? '..' : '' }}</span></td> 
                </tr>
                @endforeach 
                <div class="links">  
                    {{ $previous_records->onEachSide(1)->links() }}   
                </div>  
            </table>
            <button type="submit" name="Delete_">Delete</button>
            </form>
        </div>
    </section>

    <script src="JS/Tooltips.js"></script>
    <script src="JS/Resizable.js"></script>
    <script src="JS/Records/Scripts.js"></script>  

@endsection 
