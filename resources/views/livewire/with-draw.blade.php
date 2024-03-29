    <div>
        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="withDraw" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Deposit Cash</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
                  <div class="modal-body">
                      <form action="" method="">
                        <div class="form-group">
                            <label>Enter Amount</label>
                            <input type="number" class="form-control"  wire:model='amount' name="amount" >
                            @if($errors->has('amount'))
                                      <span class="text-danger">{{ $errors->first('amount')}}</span>
                              @endif
                        </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" wire:click.prevent='withDraw()'>With Draw</button>
                  </div>
            </div>
          </div>
        </div>


    </div>
