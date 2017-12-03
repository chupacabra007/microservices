local lrw = require "resty.waf"
local waf = lrw:new()
waf:set_option("debug", true)
waf:set_option("mode", "ACTIVE")
waf:exec()