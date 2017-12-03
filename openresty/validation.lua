local redis = require "resty.redis"
local JwtValidation = require "src.JwtValidation"

local validator = JwtValidation()
local token = ngx.var.http_Authorization
validator:verifyToken(token)