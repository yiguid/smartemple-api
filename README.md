# smartemple-api
# $id为选中法师的id
# $i为第几页，$j为显示多少条数据.默认为第一页显示十条

注册：
http://temple.irockwill.com/json/register/vcode_commit         
发送验证码，返回1表示已被注册.需要参数'phone(手机号码)'
http://temple.irockwill.com/json/register/register_commit      注册验证，返回1表示注册成功,2表示用户名已存在,3表示验证码不正确.需要参数'vcode(填写的验证码)'

法师：
http://temple.irockwill.com/json/master/all/$i/$j              返回全部法师的信息
http://temple.irockwill.com/json/master/recommend/$i/$j        返回推荐法师的信息
http://temple.irockwill.com/json/master/hot/$i/$j              返回热门法师的信息
http://temple.irockwill.com/json/master/search/$i/$j           返回与搜索关键字相关法师的信息
选中的法师：
http://temple.irockwill.com/json/master/timeline/$id/$i/$j     返回选中法师的时光轴信息
http://temple.irockwill.com/json/master/voice/$id/$i/$j        返回选中法师的语音开示信息
http://temple.irockwill.com/json/master/question/$id/$i/$j     返回选中法师的问答信息
http://temple.irockwill.com/json/master/views/$id/$i/$j        选中法师的访问量+1
http://temple.irockwill.com/json/master/likes/$id/$i/$j        选中法师的关注度+1
http://temple.irockwill.com/json/master/liked/$id/$i/$j        选中法师的关注度-1

寺院：
http://temple.irockwill.com/json/temple/all/$i/$j              返回全部寺院的信息
http://temple.irockwill.com/json/temple/recommend/$i/$j        返回推荐寺院的信息
http://temple.irockwill.com/json/temple/hot/$i/$j              返回热门寺院的信息
http://temple.irockwill.com/json/temple/search/$i/$j           返回与搜索关键字相关寺院的信息
选中的寺院：
http://temple.irockwill.com/json/temple/donation/$id/$i/$j     返回选中寺院的捐助信息
http://temple.irockwill.com/json/temple/d_zhongchou/$id/$i/$j  返回选中寺院的众筹信息
http://temple.irockwill.com/json/temple/news/$id/$i/$j         返回选中寺院的新闻信息
http://temple.irockwill.com/json/temple/activity/$id/$i/$j     返回选中寺院的活动信息
http://temple.irockwill.com/json/temple/volunteer/$id/$i/$j    返回选中寺院的义工信息
http://temple.irockwill.com/json/temple/wish/$id/$i/$j         返回选中寺院的祈福信息

发现：
http://temple.irockwill.com/json/find/temple/$i/$j             返回推荐的寺院信息
http://temple.irockwill.com/json/find/master/$i/$j             返回推荐的法师信息
http://temple.irockwill.com/json/find/news/$i/$j               返回最新新闻的信息
http://temple.irockwill.com/json/find/activity/$i/$j           返回最新活动的信息

我：
http://temple.irockwill.com/json/user/donation/$id/$i/$j       返回我的捐助的信息
http://temple.irockwill.com/json/user/donation_zhongchou/$id/$i/$j   返回我的众筹的信息
http://temple.irockwill.com/json/user/wish/$id/$i/$j           返回我的祈福的信息
http://temple.irockwill.com/json/user/activity/$id/$i/$j       返回我的活动的信息
http://temple.irockwill.com/json/user/volunteer/$id/$i/$j      返回我的义工的信息
http://temple.irockwill.com/json/user/setting/$id/$i/$j        返回我的个人信息
