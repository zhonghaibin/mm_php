## 蜜蜜妈妈


### 打包docker镜像
```
 docker build -t zhonghaibin/mm_php:1.0 -f Dockerfile .

 docker run --name=mm_php -d -p 8000:8000 zhonghaibin/mm_php:1.0
```


###  推送到docker仓库
```
 docker login

 docker push  zhonghaibin/mm_php:1.0

 docker run --name=mm_php -d -p 8000:8000  zhonghaibin/mm_php:1.0
```
