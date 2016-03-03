<div class="modal fade" id="login-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">居士登录 <small style="color:#938561">游山参禅，乐水悟道，无限逍遥</small></h4>
      </div>
      <form action="<?php echo base_url();?>login" method="post">
      <div class="modal-body" style="padding-bottom:10px;">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="用户名/手机号" id="username" name="username">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="密码" id="password" name="password">
          </div>
          <div style="height:30px; line-height:30px; font-size:14px;">
            <a style="color:#E40000;" href="<?php echo base_url()?>visit/register">还没有帐号？点击注册</a>
          </div>
      </div>
      <div class="modal-footer" style="line-height:40px; padding:0 20px 0 0 !important; margin:0px !important;">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="submit" class="btn btn-primary">登录</button>
      </div>
      </form>
    </div>
  </div>
</div>