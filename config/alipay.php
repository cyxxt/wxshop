<?php
return [


		//应用ID,您的APPID。
		'app_id' => "2016092600601703",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEowIBAAKCAQEA4HeFS1QyeGabcjLStp6aeFuWF9U2YyfG7nhc3VUkNqFq+Sfpu++NkiBG7aTVEfnfX2Qo6POsb0DweNhiYxaj3V/Bio/wq2yDUqHMk+EbHo7RXG1H6a2A6NHzZxvCi8yHIKOiYbHJhGApWF43uhxf4G3Bexyut8f80dUk91VvZQUbyOA445VvjQ3V0IjUMxxX7sc9JDLAMJzlbKhG442/Rl3n9+ocLW4W/WPTFTRIkrvxlKKaBiSnEZq6/EMOEsiqml2COriTuOi+abcozQL7jiPvsyGO+AH2bLIrtcREvyqXOW5sYerXQgYZULch37gA3i72sWi6+bzpPT6neFs1fwIDAQABAoIBAElBOFMZK093zQs74uCOakMVQKqOfq1lcdqplUT2YFcj3tFpYTJgP4eM2Rj9TjwLnAZ5nZBI1eGJA/GsTI+h9+BrO7KIvzZyt3jkLOul7z/NxC2xzGJKqWNSAWmI+bi+Cutv+7J+XxHAgD3CodUvJWsM5rPS7II11iB0uxes3inNIGw+01Tyh8sRRHOEU/CzP3/0G8s5+pgHPmoay7ElD3ebbNrBtqPyPUv/YmfMPUzh8REiEhDj6rlVnIKuNaI+ClaAjHCvWO6agm1kc0VGpTK5ErMAiuoL1FeY+qMYWC8CddwZus9VvOcrDZIUdW6rz1ME1YyKfA2dVpyNn4TSKkECgYEA+QK8IyMuhKzN5crdJW6OPI1986yiUkNSTe34rFMGhHZZcS1KtrAM2JLjAOzn+IlArt4XuV9HT/EE7z6TKKrJ189T+TQTZzE0dv1cO7JwO5V68TE7nxiUJ/6u8n8N6DTlHGhVluaHGgUtS8Hw/lem6R2J3yITa7KtckCRZWSKJQkCgYEA5sRtJptrHy/PJPcPCNxP3TJrSGv05u/Oj29yTJ76akyC/40FjMb07jHbLz2epgLiLGnOM+ABos5sdKYND8Wx+S8pe2n+QRgPndfOKLC9z1LVdIYrGMbiBh4vb3U0VdhT4WMgsubeHFvrd11voV0O3dXBw4TMwafBhI/AyovfcEcCgYEAj/+34q32ubzguNFuv7XGRVghjSe5Gs9Zqj1CwAynSTTTlnJ1sV3vn9KZubBGmWBt6nH+0DE8IQulKeFK4oqZfNalnggybEt1JpZvnwoagyp3VUF+VAu3qcVLUGqPFUh5ccsYK9KWMELsJdI61irEGCz/zOx8xJwoV1jle/f/N1kCgYBIsdYElG8RWvkxFtbYnrZV4v0iykdSvHZgfuYNtwMBm2qk4CLAbyhXJMN8RTgF6eCfxxDbDJTXWZmWwXxZ3Jgs/CtgIkqi7NZ2jbX24X5Zoil11JIc8wHelYGx5cT/ye7akGSLluifHGG3r2pr9amqPh0U32+1DYiLntFHvPo9HwKBgE675mjoJXu7W+sspWff8Q+qlXeO6SiGrgDWznxfH0/A1cETLURpA36Yu8Pnu+yNJ8ofTyNoZzw7gzTqobHvvRDIi10BbKPn9AyQ5C9PGN0kye87RdlLM5ojwCBlbUgq9uHjYrN7ajcDNkr/vz2Rmw02UtWI1T5XKh5UWfTfp4SF",
		
		//异步通知地址
		'notify_url' => "http://工程公网访问地址/alipay.trade.wap.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => "http://mitsein.com/alipay.trade.wap.pay-PHP-UTF-8/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4HeFS1QyeGabcjLStp6aeFuWF9U2YyfG7nhc3VUkNqFq+Sfpu++NkiBG7aTVEfnfX2Qo6POsb0DweNhiYxaj3V/Bio/wq2yDUqHMk+EbHo7RXG1H6a2A6NHzZxvCi8yHIKOiYbHJhGApWF43uhxf4G3Bexyut8f80dUk91VvZQUbyOA445VvjQ3V0IjUMxxX7sc9JDLAMJzlbKhG442/Rl3n9+ocLW4W/WPTFTRIkrvxlKKaBiSnEZq6/EMOEsiqml2COriTuOi+abcozQL7jiPvsyGO+AH2bLIrtcREvyqXOW5sYerXQgYZULch37gA3i72sWi6+bzpPT6neFs1fwIDAQAB",
		
	
];