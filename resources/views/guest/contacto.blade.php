@extends('guest.partials.base')

@section('title', 'Cart')

@section('content')


<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Contacto</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->

<div id="contact-us" class="contact-area section-padding">
    <div class="container">           
        <div class="row">
            <div class="col-md-12" style="margin-top:20px;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3763.443715895014!2d-99.15768728520806!3d19.393225246964047!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1ff0599c92099%3A0x24fcc9cc492c631e!2sCalle%20Yacatas%20215%2C%20Narvarte%20Poniente%2C%20Benito%20Ju%C3%A1rez%2C%2003020%20Ciudad%20de%20M%C3%A9xico%2C%20CDMX!5e0!3m2!1ses!2smx!4v1581634995864!5m2!1ses!2smx" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d24748.426151177297!2d-96.72762743936735!3d17.067050328462177!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2smx!4v1578784701027!5m2!1ses!2smx" ></iframe> --}}
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <div class="form-content">
                    <h2>Dinos lo que te interesa</h2>
                    <form id="contact" name="contact" method="post">  
                        <div class="row">
                            <div class="col-md-12">
                                <p><label for="name">Asunto</label><input placeholder="Escribe un asunto" type="text" name="name" id="name" size="30" value="" required=""></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><label for="name">Email</label><input placeholder="Escribe tu email" type="email" name="email" id="email" size="30" value="" required=""></p>
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-md-12">
                                
                                <p><label for="message">Mensaje</label><textarea placeholder="Cuéntanos algo" name="message" id="message" required=""></textarea></p>
                                
                                <div class="submit-wrapper">
                                    <p><input id="submit" type="submit" name="submit" value="Enviar">  </p>
                                </div>
                            </div>
                        </div>
                    </form>	
                </div>                     
            </div>
            
            <div class="col-md-4">
                <div class="our-address">
                    <h2>Contacto</h2>
                    <div class="single-address">
                        <i class="fa fa-home"></i>
                        <p>Av. Yacatan 215, <br>
                        Col. Narvarte Poniente.<br>
                        Ciudad de México</p>
                    </div>
                    
                    <div class="single-address">
                        <i class="fa fa-envelope"></i>
                        <p><a href="mailto:formacionycomunicacionpolitica@gmail.com">formacionycomunicacionpolitica@gmail.com</a></p>
                    </div>
                    
                    <div class="single-address">
                        <i class="fa fa-phone"></i>
                        <p>951 213 05 49</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>




@endsection

@section('scripts')


@endsection