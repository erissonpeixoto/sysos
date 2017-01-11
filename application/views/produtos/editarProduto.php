<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-align-justify"></i>
                </span>
                <h5>Editar Produto</h5>
            </div>
            <div class="widget-content nopadding">
                <?php echo $custom_error; ?>
                <form action="<?php echo current_url(); ?>" id="formProduto" method="post" class="form-horizontal" >
                     <div class="control-group">
                        <?php echo form_hidden('idProdutos',$result->idProdutos) ?>
                        <label for="descricao" class="control-label">Descrição<span class="required">*</span></label>
                        <div class="controls">
                            <input id="descricao" type="text" name="descricao" value="<?php echo $result->descricao; ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="unidade" class="control-label">Unidade<span class="required">*</span></label>
                        <div class="controls">
                            <input id="unidade" type="text" name="unidade" value="<?php echo $result->unidade; ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="precoCompra" class="control-label">Preço de Compra<span class="required">*</span></label>
                        <div class="controls">
                            <input id="precoCompra" class="money" type="text" name="precoCompra" value="<?php echo $result->precoCompra; ?>"  onblur="calculaPrecoVenda();"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="percentualPrecoVenda" class="control-label">% Margem Lucro</label>
                        <div class="controls">
                            <input id="percentualPrecoVenda" class="money" type="text" name="percentualPrecoVenda" value="<?php echo $result->percentualPrecoVenda; ?>" placeholder="Ex. 5.00 %" onblur="calculaPrecoVenda();"/><strong>%  </strong><span style="color: red">Porcentagem aplicada no preço de venda</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="precoVenda" class="control-label">Preço de Venda<span class="required">*</span></label>
                        <div class="controls">
                            <input id="precoVenda" class="money" type="text" name="precoVenda" onblur="calculaMargemLucro();" value="<?php echo $result->precoVenda; ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="estoque" class="control-label">Estoque<span class="required">*</span></label>
                        <div class="controls">
                            <input id="estoque" type="text" name="estoque" value="<?php echo $result->estoque; ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="estoqueMinimo" class="control-label">Estoque Mínimo</label>
                        <div class="controls">
                            <input id="estoqueMinimo" type="text" name="estoqueMinimo" value="<?php echo $result->estoqueMinimo; ?>"  />
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Alterar</button>
                                <a href="<?php echo base_url() ?>index.php/produtos" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    </div>


                </form>
            </div>

         </div>
     </div>
</div>


<script src="<?php echo base_url()?>js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>js/maskmoney.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".money").maskMoney();

        $('#formProduto').validate({
            rules :{
                  descricao: { required: true},
                  unidade: { required: true},
                  precoCompra: { required: true},
                  precoVenda: { required: true},
                  estoque: { required: true}
            },
            messages:{
                  descricao: { required: 'Campo Requerido.'},
                  unidade: {required: 'Campo Requerido.'},
                  precoCompra: { required: 'Campo Requerido.'},
                  precoVenda: { required: 'Campo Requerido.'},
                  estoque: { required: 'Campo Requerido.'}
            },

            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
           });
    });
    
    function calculaPrecoVenda(){
      if($('#precoCompra').val() != '' && $("#percentualPrecoVenda").val() != ''){
        var valorTotal = parseFloat($("#precoCompra").val()) + parseFloat(($("#precoCompra").val() * ($("#percentualPrecoVenda").val()/100)));
        valorTotal = parseFloat(valorTotal).toFixed(2);
        $('#precoVenda').val(valorTotal);        
      }else if($('#precoCompra').val() != '' && $('#precoVenda').val() != ''){
        calculaMargemLucro();
      }    
    }

    function calculaMargemLucro(){
      if($('#precoCompra').val() != '' && $('#precoVenda').val() != ''){
        var margemLucro = parseFloat((parseFloat($("#precoVenda").val()) - parseFloat($("#precoCompra").val()))*100)/parseFloat($("#precoCompra").val());
        margemLucro = parseFloat(margemLucro).toFixed(2);
        $('#percentualPrecoVenda').val(margemLucro);        
      }    
    }
</script>




