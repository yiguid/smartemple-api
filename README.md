# smartemple-api
# masterid为选中法师的id
# templeid为选中寺院的id
# userid为'我的'的id
# page为第几页，limit为显示多少条数据.


登录：
http://temple.irockwill.com/json/login
用户登录，参数post('username'),post('password'),返回用户基本信息与access_token

注册：
http://temple.irockwill.com/json/register/vcode_commit         
发送验证码，返回1表示已被注册.参数post('phone(手机号码)')
http://temple.irockwill.com/json/register/register_commit      注册验证，返回1表示注册成功,2表示用户名已存在,3表示验证码不正确.参数post('vcode(填写的验证码)')


法师：
http://temple.irockwill.com/json/master/all
返回全部法师的信息,参数get('page'),get('limit'),get('access_token')
http://temple.irockwill.com/json/master/recommend                
返回推荐法师的信息,参数get('page'),get('limit'),get('access_token')
http://temple.irockwill.com/json/master/hot                       
返回热门法师的信息,参数get('page'),get('limit'),get('access_token') 
http://temple.irockwill.com/json/master/search                    
返回与搜索关键字相关法师的信息,参数get('page'),get('limit'),get('searchmaster(搜索关键字)'),get('access_token') 

选中的法师：
http://temple.irockwill.com/json/master/info
返回选中法师的基本信息,参数get('masterid'),get('access_token')
http://temple.irockwill.com/json/master/timeline              
返回选中法师的时光轴信息,参数get('page'),get('limit'),get('masterid'),get('access_token')
http://temple.irockwill.com/json/master/voice               
返回选中法师的语音开示信息,参数get('page'),get('limit'),get('masterid'),get('access_token')
http://temple.irockwill.com/json/master/question             
返回选中法师的问答信息,参数get('page'),get('limit'),get('masterid'),get('access_token')
http://temple.irockwill.com/json/master/views          
选中法师的访问量+1,参数post('masterid')
http://temple.irockwill.com/json/master/likes                 
选中法师的关注度+1,参数post('masterid')
http://temple.irockwill.com/json/master/liked                 
选中法师的关注度-1,参数post('masterid')


寺院：
http://temple.irockwill.com/json/temple/all                      
返回全部寺院的信息,参数get('page'),get('limit'),get('access_token')
http://temple.irockwill.com/json/temple/recommend                  
返回推荐寺院的信息,参数get('page'),get('limit'),get('access_token')
http://temple.irockwill.com/json/temple/hot                     
返回热门寺院的信息,参数get('page'),get('limit'),get('access_token')
http://temple.irockwill.com/json/temple/search                
返回与搜索关键字相关寺院的信息,参数get('page'),get('limit'),get('searchtemple(搜索关键字)'),get('access_token')

选中的寺院：
http://temple.irockwill.com/json/temple/income_count
返回选中寺院的捐款金额、人数,参数get('templeid'),get('access_token'),get('rolltime(month取本月，day取当天，不带此参数取全部)')
http://temple.irockwill.com/json/temple/info             
返回选中寺院的基本信息,参数get('templeid'),get('access_token')
http://temple.irockwill.com/json/temple/donation             
返回选中寺院的捐助信息,参数get('page'),get('limit'),get('templeid'),get('access_token')
http://temple.irockwill.com/json/temple/d_zhongchou           
返回选中寺院的众筹信息,参数get('page'),get('limit'),get('templeid'),get('access_token')
http://temple.irockwill.com/json/temple/news                 
返回选中寺院的新闻信息,参数get('page'),get('limit'),get('templeid'),get('access_token')
http://temple.irockwill.com/json/temple/activity              
返回选中寺院的活动、义工信息,参数get('page'),get('limit'),get('templeid'),get('access_token')
http://temple.irockwill.com/json/temple/wish                
返回选中寺院的祈福信息,参数get('page'),get('limit'),get('templeid'),get('access_token')
http://temple.irockwill.com/json/temple/message
插入留言,参数post('realname(用户名)'),post('content(留言内容)'),post('templeid'),post('location(用户地理位置)'),post('fromurl(字符串'app/qf')'),post('ip'),post('userid'),post('access_token')返回1 成功，0失败


发现：
http://temple.irockwill.com/json/find/temple                      
返回推荐的寺院信息,参数get('page'),get('limit'),get('access_token')
http://temple.irockwill.com/json/find/master                     
返回推荐的法师信息,参数get('page'),get('limit'),get('access_token')
http://temple.irockwill.com/json/find/news                     
返回最新新闻的信息,参数get('page'),get('limit'),get('access_token')
http://temple.irockwill.com/json/find/activity                  
返回最新活动的信息,参数get('page'),get('limit'),get('access_token')
http://temple.irockwill.com/json/find/new_views
选中新闻的访问量+1,参数post('id'),post('access_token')
http://temple.irockwill.com/json/find/ac_views
选中活动/义工的访问量+1,参数post('id'),post('type'),post('access_token')
http://temple.irockwill.com/json/find/new_detail
返回新闻的详情,参数get('id'),get('access_token')
http://temple.irockwill.com/json/find/ac_detail
返回活动/义工的详情,参数get('id'),get('type'),get('access_token')


我：
http://temple.irockwill.com/json/user/donation                 
返回我的捐助的信息,参数get('page'),get('limit'),get('userid'),get('access_token')
http://temple.irockwill.com/json/user/donation_zhongchou      
返回我的众筹的信息,参数get('page'),get('limit'),get('userid'),get('access_token')
http://temple.irockwill.com/json/user/wish                    
返回我的祈福的信息,参数get('page'),get('limit'),get('userid'),get('access_token')
http://temple.irockwill.com/json/user/activity                
返回我的活动的信息,参数get('page'),get('limit'),get('userid'),get('access_token')
http://temple.irockwill.com/json/user/volunteer               
返回我的义工的信息,参数get('page'),get('limit'),get('userid'),get('access_token')
http://temple.irockwill.com/json/user/info              
返回我的个人的信息,参数get('userid'),get('access_token')
http://temple.irockwill.com/json/user/update            //待
http://temple.irockwill.com/json/user/update_detail     //待

