function encodeURI(s)
    s = string.gsub(s, "([^%w%.%- ])", function(c) return string.format("%%%02X", string.byte(c)) end)
    return string.gsub(s, " ", "+")
end

function on_msg_receive (msg)
local handle = io.popen( "wget [your BOT.php url here]?to="..encodeURI(msg.to.print_name).."&from="..encodeURI(msg.from.print_name).."&text="..encodeURI(msg.text) )
local result = handle:read("*a")
handle:close()
end