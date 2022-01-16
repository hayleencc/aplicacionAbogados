require 'open-uri'
require 'nokogiri'
require 'csv'
require "pry"


class Link 

  linkAbg = "https://app.funcionjudicial.gob.ec/ForoAbogados/Publico/frmConsultasGenerales.jsp"

  pagina = open(link)
  doc = Nokogiri::HTML(pagina)

  binding.pry

  def scrapperAbogados

  end

end

a = Link.new