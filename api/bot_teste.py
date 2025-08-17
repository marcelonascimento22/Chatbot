
import api_chat


driver = api_chat.main()
teste = api_chat.send_whatsapp_message(driver, "Meu Claro", "Olá, esta é uma mensagem de teste enviada via automação Python!")