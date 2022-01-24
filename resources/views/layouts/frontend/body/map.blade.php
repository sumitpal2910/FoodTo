<!-- Modal -->
<div class="modal fade " id="mapModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="map-modal-dialog modal-dialog  modal-lg modal-dialog-scrollable  ">
        <div class="modal-content map">
            <div class="map-header">

                <button type="button" class="close ml-5 mt-4 float-left" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">

                <!--Address Box-->
                <div id="address-box" class="box">
                    <div class="dropdown">
                        <div class="form-group">
                            <input id="addressSearchBox" type="text" class="form-control "
                                placeholder="Search area or location">
                        </div>

                        <div class="dropdown-menu map-dropdown" id="mapSearchDropdown">
                            <h6 class="dropdown-header">Search Address</h6>

                        </div>
                    </div>


                    <button onclick="showTab(); locateMe();" id="locateMe" class="map-card"> <i
                            class="icofont-ui-pointer"></i>
                        Locate Me
                        <br>
                        <small>Click to show your location in map</small>
                    </button>
                </div>


                <!--Map Tab-->
                <div id="mapbox" class="d-none box">
                    <button type="button" class="btn btn-outline-secondary mb-3" onclick="showTab()"><i
                            class="icofont-arrow-left"></i></button>



                    <div id='map' style='width: 350px; height: 280px;'></div>
                    <div id='map-leaflet' class='map'></div>

                    <form action="" id="addressForm">
                        <div class="form-group  mt-3">
                            <label class="text-secondary"><small>Address</small></label>
                            <input readonly name="full_address" class="form-control map-card mt-3 mb-3" id="address">
                            <!--Pincode-->
                            <input required id="pincode" type="text" class="form-control map-input"
                                placeholder="pincode" name="pincode">
                        </div>

                        <input type="hidden" name="lat">
                        <input type="hidden" name="long">

                        <button type="button" onclick="addressDetail(event)" class="map-card mb-3">
                            <b>Add More Details </b>
                            <br>
                            <small>for Fast checkout</small>
                        </button>

                        <div class="d-none card mb-3" id="addressDetails">

                            <!--Flat No-->
                            <input id="doorNo" type="text" class="form-control map-input" placeholder="Door/House No"
                                name="house_no">

                            <!--Landmark-->
                            <input id="landmark" type="text" name="landmark" class="form-control map-input"
                                placeholder="landmark">

                            <!--Location Type-->
                            <div class="row d-flex justify-content-around mb-3 mt-3">
                                <div class="custom-control custom-radio ">
                                    <input onchange="showInput(event)" type="radio"
                                        class="custom-control-input typeInput" id="home" value="home" name="type"
                                        checked>
                                    <label class="custom-control-label" for="home">Home</label>
                                </div>
                                <div class="custom-control custom-radio  ">
                                    <input onchange="showInput(event)" type="radio"
                                        class="custom-control-input typeInput" id="work" value="work" name="type">
                                    <label class="custom-control-label" for="work">Work</label>
                                </div>
                                <div class="custom-control custom-radio  ">
                                    <input onchange="showInput(event)" type="radio"
                                        class="custom-control-input typeInput" id="other" value="other" name="type">
                                    <label class="custom-control-label" for="other">Other</label>
                                </div>
                            </div>


                            <input type="text" name="other_type" placeholder="Father's house"
                                class="form-control map-input d-none mb-3" id="otherInput">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">SAVE ADDRESS & PROCEED</button>

                    </form>

                </div>

            </div>
        </div>
    </div>

    <script>




    </script>
