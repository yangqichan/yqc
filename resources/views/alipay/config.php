<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016101900723515",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEowIBAAKCAQEA2Kek4m4jbv2kZoK02By6ACQj52n13dLmt6LiiCpwF8LKwK4DEqog7exgKPlR0d/i07I4NbG8n515GY5QbehewszyVJb8rQ2Q05DNlwhjEbd7n8One9nfHuxoa5m90gJQ4dFp48OD3JLirsoEM5BLqtk03Hcvzpvt6GQKjQOOKm/e3n5RXwE1qrHbC1Iermm9Xxt6UaWfCCH9S7eiw/X2ZUVgbSfzfWQBdUMW//dQRHxw3aeBnUQbrMEk3pmJCo0VLeMi5LtG0twKDsMvVYHGwCesMVS4O6zZCbrdkYCy3uWoVDv7Ot28dGx6JT9slc7MrgOq++nSh816OVmW6jXYDwIDAQABAoIBAGF2eRxLg7EodU6QOh6GPb5Wg7hU2IAjohq2McYjoS1vOZqYLVW2Jv4hOdj037PUTcwB/ntZK4t6YcH3XYMz530miVU4Xw7SbXZfS71HzplnuztR3wQ+LLtSil7tWJEi7ZPIiyQlDiqqAUO0KVOw8/k1oSwUifMd/lZuurhZAxlfSX5yM1g3uiWMTlDK1KL3RPcrI/8yST/P7FTuvsL0wPD1P0Kqhef2xc4r5dRXcVY7BuuB2YAomOqmahA84ED/Je0YNL4G4Zh3W8O5kqERUMmKIfPkuxzjFwGR87UFGWlpw1hM8MoahCrJ2yjzY1bSOgwPkeY2CinkOwXymLe6xMECgYEA/6d8SRAFSFXJ2D2rTe4/YL5Tr9gAAHV6Hvq5Y31neKsmPdISD1U/r3OYDvQOdiWTkXiZ5cGF8VEISRbUDukvoPMq/zKUL8/hpHFGtFypqe1B1GOZsSLQ/2jyxPK/hX0RGvGdIELafeTmcqrG00TpDEdYjkOnF9kwWOKj7swxfJECgYEA2PKn61rafkvfLC2gYJ3if+4uoBkRuOHfJRPahuFiJ79zljK7XzY4YXRb9iyd+GkqcEvh43XjJZbKnkeiC4qYE03+t+rOOognW1wJnXTXeKaNlzegMAz6c2uY1KyAe7NkAraECC6i7WDOsPOLt4gtzDmj7Dv8fug3E5mpLogG2p8CgYEA45ZQGCLA8SId6/kKVPfxR8hna7UYW1A5hPairyTmRg/mnUYzeZ7kcOawyS8O6LKO6gO4zUY4XRlMDPTbluKT2e5fqot2TBH9x4xn6wxKpdFmtxJrsbtS3uyooheP0+AAqEHLJPse0tBBLndFRLKl3J5vAUbMq3hXh+lLEryImWECgYBroM6fm14kI/3ey+/xnsJcl0x4TpeVMjFjEptqKOxqLbfpPtfoH10PNAvfcDkaoQnV1j+Fedmrr0hsB7ujoClcAmio04tmTF/CGkIG5I11JKO/7m/BBt9FXY7fi4jeVZv7IJMWABUCUPGZpemdrqiR1dK2Avh7+TZBugzNsdw8nwKBgCKBt7EiwpYFf4EvwgZ3+9RxYcJAfhLnoMQM5NINPr/xnRY1d9XeF5f+Mrg8o1UkQimosGE5N4ywtgmNn1kaoNI7PMi+ACeeCLnTrHkENwHuVm4JJUIvYxyWHMqWC4kORrnEh30qOLCh0KElwLVUYfudT+VVuFE0dRJYjjRoZLco",
		
		//异步通知地址
		'notify_url' => "http://工程公网访问地址/alipay.trade.wap.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => "http://localhost/alipay/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "	
https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAho7j9/PE3vg8pMOK24gdb/WSe0Jzirf4zU9hdakwyE6jz5I1NynqIc4gavkeCWEc3rikbaDyDFbbpAVF4kiy/Wrm3C0u4ECxYkoEnRkucgkbgR4L3HrAwB+o2rVimI/Lj18tVw5ZTftrTbuMnTPTrOLek0pX8QZSVOh1g36oJ/yYUKbPk9tTekA2G8CmGQL/tynK+f6TbCCNZnYUeM6cLKK1jIeNNYyewnmweOEtEVtPAx4jtAWftjhHnMgsr3rh+xmIHZJyLnGArOIz+XJL2IfyN/AIgf07OpAQWzq147RV4ebxlcO9GM7PH3EPmGkeH1TWW/N+LJ8DjfUMGfwtPwIDAQAB",
		
	
);