import HTMLParser
from selenium.webdriver.common.keys import Keys
from selenium import webdriver

#replace with the url
url = "http://YOUR.URL.COM"
browser = webdriver.Firefox()
browser.get(url)

# replace by the title of the web page
assert "THE BROWSER TITLE" in browser.title

#the element to be found
elem = browser.find_element_by_name("jobref")
#reference number
elem.send_keys("SOME NUMBER")

htmli = browser.page_source
start = htmli.find('Question:') + 9
end = htmli.find('*')
end2 = htmli.find('+')
end3 = htmli[start:].find('p>')
a= htmli[start:end]
b= htmli[end+1:end2]
c= htmli[end2+1:end3+start-9]

html = HTMLParser.HTMLParser()
one= html.unescape(a)
two= html.unescape(b)
three = html.unescape(c)
print(one, two, three)
partans= int(one)*int(two)
ans = partans + int(three)
print(ans)

answer = browser.find_element_by_name("value")
answer.send_keys(ans)
answer.send_keys(Keys.RETURN)
