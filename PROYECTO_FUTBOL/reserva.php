<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <div class="modal-title" > <i>Reservas de Asientos</i></div>
        </div>
        <form role="form" action="" name="frmReserva">

          <div class="col-md-12">
            <table class="table table-striped">
                <tr>
                  <th>Sección</th>
                  <th>Precio</th>
                  <th>Disponible</th>
                  <th style="width: 140px">Reservar</th>
                  <th># Asientos</th>
                  
                </tr>               
                
                  <tr>
                    <td>TRIBUNAL</td>
                      <td>$ 25.00</td>
                      <td> 50</td>
                      <td>
                          <input class="form-control input-sm" placeholder="Cantidad" name="cantidad" type="number" max="50" autofocus required>
                      </td>
                      
                  </tr>
                
                
                  
              </table>
            </div>
          
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" onClick="Registrar(idP, accion); return false">
              <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Grabar
          </button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Cancel</button>
        </div>
      </div>
    </div>
  </div>