local jwt = require 'resty.jwt'
local conf = require 'conf'



local JwtValidation = {
    _VERSION = 'JwtValidation 1.0.0',
    _DESCRIPTION = 'A Lua client library for validating Json Web Tokens',
    _COPYRIGHT = 'Use it for free at your risk'
}


JwtValidation.__index = JwtValidation


setmetatable(JwtValidation, {
    __call = function (cls, ...)
        return cls.new(...)
    end
})


function JwtValidation.new()
    jwt:set_alg_whitelist({RS256 = 1})
    local self = setmetatable({}, JwtValidation)
    return self
end

function JwtValidation:throwError(msg)
    ngx.status = 401
    ngx.say(msg)
    ngx.exit(ngx.HTTP_UNAUTHORIZED)
end


function JwtValidation:verifyToken(token)
    if token == nil then
        self:throwError("Token header is missing")
    end
    
    local _, _, token = string.find(token, 'Bearer%s+(.+)')
    if token == nil then
        self:throwError("Token is value is missing")
    end
    
    local jwt_obj = jwt:verify(conf.public_key, token)
    if not jwt_obj.verified then
        self:throwError("Token is invalid")
    end
end

return JwtValidation

