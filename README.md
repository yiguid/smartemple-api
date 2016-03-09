# smartemple-api
# masterid为选中法师的id
# templeid为选中寺院的id
# userid为'我的'的id
# page为第几页，limit为显示多少条数据.


注册：
http://temple.irockwill.com/json/register/vcode_commit         
发送验证码，返回1表示已被注册.参数post('phone(手机号码)')
http://temple.irockwill.com/json/register/register_commit      注册验证，返回1表示注册成功,2表示用户名已存在,3表示验证码不正确.参数post('vcode(填写的验证码)')


法师：
http://temple.irockwill.com/json/master/all
返回全部法师的信息,参数get('page'),get('limit') 
http://temple.irockwill.com/json/master/recommend                
返回推荐法师的信息,参数get('page'),get('limit') 
http://temple.irockwill.com/json/master/hot                       
返回热门法师的信息,参数get('page'),get('limit') 
http://temple.irockwill.com/json/master/search                    
返回与搜索关键字相关法师的信息,参数get('page'),get('limit'),get('searchmaster(搜索关键字)') 

选中的法师：
http://temple.irockwill.com/json/master/timeline              
返回选中法师的时光轴信息,参数get('page'),get('limit'),get('masterid')
http://temple.irockwill.com/json/master/voice               
返回选中法师的语音开示信息,参数get('page'),get('limit'),get('masterid')
http://temple.irockwill.com/json/master/question             
返回选中法师的问答信息,参数get('page'),get('limit'),get('masterid')
http://temple.irockwill.com/json/master/views          
选中法师的访问量+1,参数post('masterid')
http://temple.irockwill.com/json/master/likes                 
选中法师的关注度+1,参数post('masterid')
http://temple.irockwill.com/json/master/liked                 
选中法师的关注度-1,参数post('masterid')


寺院：
http://temple.irockwill.com/json/temple/all                      
返回全部寺院的信息,参数get('page'),get('limit')
http://temple.irockwill.com/json/temple/recommend                  
返回推荐寺院的信息,参数get('page'),get('limit')
http://temple.irockwill.com/json/temple/hot                     
返回热门寺院的信息,参数get('page'),get('limit')
http://temple.irockwill.com/json/temple/search                
返回与搜索关键字相关寺院的信息,参数get('page'),get('limit'),get('searchtemple(搜索关键字)')

选中的寺院：
http://temple.irockwill.com/json/temple/donation             
返回选中寺院的捐助信息,参数get('page'),get('limit'),get('templeid')
http://temple.irockwill.com/json/temple/d_zhongchou           
返回选中寺院的众筹信息,参数get('page'),get('limit'),get('templeid')
http://temple.irockwill.com/json/temple/news                 
返回选中寺院的新闻信息,参数get('page'),get('limit'),get('templeid')
http://temple.irockwill.com/json/temple/activity              
返回选中寺院的活动信息,参数get('page'),get('limit'),get('templeid')
http://temple.irockwill.com/json/temple/volunteer              
返回选中寺院的义工信息,参数get('page'),get('limit'),get('templeid')
http://temple.irockwill.com/json/temple/wish                
返回选中寺院的祈福信息,参数get('page'),get('limit'),get('templeid')
http://temple.irockwill.com/json/temple/message
插入留言,参数get('realname(用户名)'),get('content(留言内容)'),get('templeid'),get('location(用户地理位置)'),get('fromurl(字符串'app/qf')'),get('ip'),get('userid')


发现：
http://temple.irockwill.com/json/find/temple                      
返回推荐的寺院信息,参数get('page'),get('limit')
http://temple.irockwill.com/json/find/master                     
返回推荐的法师信息,参数get('page'),get('limit')
http://temple.irockwill.com/json/find/news                     
返回最新新闻的信息,参数get('page'),get('limit')
http://temple.irockwill.com/json/find/activity                  
返回最新活动的信息,参数get('page'),get('limit')


我：
http://temple.irockwill.com/json/user/donation                 
返回我的捐助的信息,参数get('page'),get('limit'),get('userid')
http://temple.irockwill.com/json/user/donation_zhongchou      
返回我的众筹的信息,参数get('page'),get('limit'),get('userid')
http://temple.irockwill.com/json/user/wish                    
返回我的祈福的信息,参数get('page'),get('limit'),get('userid')
http://temple.irockwill.com/json/user/activity                
返回我的活动的信息,参数get('page'),get('limit'),get('userid')
http://temple.irockwill.com/json/user/volunteer               
返回我的义工的信息,参数get('page'),get('limit'),get('userid')
http://temple.irockwill.com/json/user/info              
返回我的个人的信息,参数get('userid')
http://temple.irockwill.com/json/user/update            //待
http://temple.irockwill.com/json/user/update_detail     //待

