
    @yield('modal_div')

    <div class="modal-dialog ">
     <!-- Modal content-->
     <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       @yield('header')
     </div>
     <div class="modal-body">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
      <input type="hidden" id="id">
      @yield('body')

    </div>
    @yield('mensajes')
    <div class="modal-footer">
     @yield('footer')
   </div>
 </div>
</div>

@yield('script')



