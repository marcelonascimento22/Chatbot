from selenium import webdriver # Importa o módulo principal do Selenium para controle do navegador
from selenium.webdriver.chrome.service import Service # Importa a classe Service para gerenciar o serviço do ChromeDriver
from selenium.webdriver.common.by import By # Importa By para especificar o método de localização de elementos (ex: por XPath, CSS Selector)
from selenium.webdriver.support.ui import WebDriverWait # Importa WebDriverWait para definir esperas explícitas por elementos
from selenium.webdriver.support import expected_conditions as EC # Importa condições esperadas (EC) para usar com WebDriverWait
from selenium.webdriver.common.keys import Keys # Importa Keys para simular pressionamento de teclas (como ENTER)
import time # Importa o módulo time para usar pausas (sleep)
import os # Importa o módulo os para interagir com o sistema operacional (caminhos de arquivos, diretórios)

def setup_driver(profile_path): # Define a função para configurar o WebDriver do Chrome
    """Configura o WebDriver do Chrome para usar um perfil específico."""
    options = webdriver.ChromeOptions() # Cria um objeto de opções para configurar o Chrome
    options.add_argument(f"user-data-dir={profile_path}") # Adiciona um argumento para usar um diretório de perfil específico, salvando a sessão
    #options.add_argument("--disable-gpu") # Desabilita a GPU de hardware para evitar alguns problemas de renderização
    #options.add_argument("--no-sandbox") # Desabilita o sandbox para ambientes Linux onde pode ser necessário
    #options.add_argument("--disable-dev-shm-usage") # Desabilita o uso de /dev/shm para ambientes Linux, útil para Docker
    options.add_argument("start-maximized") # Abre o navegador maximizado

    service = Service() # Cria um objeto Service para o ChromeDriver (assume que chromedriver está no PATH)
    driver = webdriver.Chrome(service=service, options=options) # Inicializa o WebDriver do Chrome com as opções e serviço configurados
    return driver # Retorna o objeto driver configurado

def open_whatsapp_web(driver): # Define a função para abrir e aguardar o carregamento do WhatsApp Web
    """Abre o WhatsApp Web e aguarda o carregamento."""
    driver.get("https://web.whatsapp.com/") # Navega para a URL do WhatsApp Web
    print("Aguardando o carregamento do WhatsApp Web...") # Imprime mensagem de status
    try: # Inicia um bloco try-except para lidar com possíveis erros durante o carregamento
        # Aguarda até que o QR Code (para login inicial) ou a tela principal do WhatsApp (sessão restaurada) apareça
        WebDriverWait(driver, 60).until( # Espera explicitamente por até 60 segundos
            EC.any_of( # Espera que qualquer uma das condições seja verdadeira
                EC.presence_of_element_located((By.CSS_SELECTOR, 'canvas[aria-label="Scan me!"]')), # Condição: QR Code presente
                EC.presence_of_element_located((By.XPATH, '//div[@id="app"]/div/div/div[4]/div/div[2]/div/div[1]/div/div/div[2]/div')) # Condição: Parte da interface de chats presente
            )
        )
        print("WhatsApp Web carregado. Por favor, faça o login se for solicitado.") # Imprime mensagem de instrução
        # Dê um tempo adicional para o usuário escanear o QR code ou a sessão ser restaurada
        time.sleep(15) # Pausa o script por 15 segundos (tempo para interação manual, se necessário)
        # Verificar se o login foi bem-sucedido (procurar pela barra de pesquisa de chats, que indica sucesso)
        WebDriverWait(driver, 30).until( # Espera explicitamente por até 30 segundos
            EC.presence_of_element_located((By.XPATH, '//div[@role="textbox"][@title="Pesquisar ou começar uma nova conversa"]')) # Condição: barra de pesquisa de chats presente
        )
        print("Login/restauração da sessão bem-sucedido.") # Imprime mensagem de sucesso
    except Exception as e: # Captura qualquer exceção que ocorra no bloco try
        print(f"Erro ao carregar o WhatsApp Web ou o login demorou muito: {e}") # Imprime mensagem de erro
        print("Certifique-se de que o QR Code foi escaneado a tempo ou a sessão foi restaurada.") # Imprime dica de depuração
        driver.quit() # Fecha o navegador em caso de erro fatal no login
        exit() # Encerra o script

def send_whatsapp_message(driver, contact_name, message): # Define a função para enviar uma mensagem do WhatsApp
    """
    Encontra um contato e envia uma mensagem.
    Args:
        driver: O WebDriver do Selenium.
        contact_name: O nome exato do contato ou grupo no WhatsApp.
        message: A mensagem a ser enviada.
    """ # Docstring: descreve a função e seus argumentos
    print(f"\nTentando enviar mensagem para '{contact_name}'...") # Imprime mensagem de status
    try: # Inicia um bloco try-except para lidar com erros no envio da mensagem
        # 1. Encontrar a barra de pesquisa de chats
        search_box_xpath = '//div[@role="textbox"][@title="Pesquisar ou começar uma nova conversa"]' # Define o XPath para a barra de pesquisa
        search_box = WebDriverWait(driver, 10).until( # Espera explicitamente por até 10 segundos
            EC.element_to_be_clickable((By.XPATH, search_box_xpath)) # Condição: elemento clicável
        )
        search_box.click() # Clica na barra de pesquisa para ativá-la
        search_box.clear() # Limpa qualquer texto pré-existente na barra de pesquisa
        search_box.send_keys(contact_name) # Digita o nome do contato na barra de pesquisa
        time.sleep(2) # Pausa o script por 2 segundos para os resultados da pesquisa carregarem

        # 2. Clicar no contato/conversa
        contact_xpath = f'//span[@title="{contact_name}"]' # Define o XPath para o contato usando o nome fornecido
        contact_element = WebDriverWait(driver, 10).until( # Espera explicitamente por até 10 segundos
            EC.element_to_be_clickable((By.XPATH, contact_xpath)) # Condição: elemento do contato clicável
        )
        contact_element.click() # Clica no elemento do contato para abrir a conversa
        print(f"Conversa com '{contact_name}' aberta.") # Imprime mensagem de status
        time.sleep(2) # Pausa o script por 2 segundos para a conversa carregar

        # 3. Encontrar a caixa de entrada de mensagem
        message_box_xpath = '//div[@role="textbox"][@title="Digite uma mensagem"]' # Define o XPath para a caixa de mensagem
        message_box = WebDriverWait(driver, 10).until( # Espera explicitamente por até 10 segundos
            EC.element_to_be_clickable((By.XPATH, message_box_xpath)) # Condição: caixa de mensagem clicável
        )
        message_box.click() # Clica na caixa de mensagem para ativá-la
        message_box.send_keys(message) # Digita a mensagem na caixa de mensagem
        print(f"Mensagem digitada: '{message}'") # Imprime a mensagem digitada
        time.sleep(1) # Pausa o script por 1 segundo antes de enviar

        # 4. Clicar no botão de envio
        send_button_xpath = '//button[@aria-label="Enviar"]' # Define o XPath para o botão de enviar
        send_button = WebDriverWait(driver, 10).until( # Espera explicitamente por até 10 segundos
            EC.element_to_be_clickable((By.XPATH, send_button_xpath)) # Condição: botão de enviar clicável
        )
        send_button.click() # Clica no botão de enviar
        print(f"Mensagem enviada com sucesso para '{contact_name}'!") # Imprime mensagem de sucesso
        time.sleep(2) # Pausa o script por 2 segundos após o envio

    except Exception as e: # Captura qualquer exceção que ocorra no bloco try de envio
        print(f"Erro ao enviar mensagem para '{contact_name}': {e}") # Imprime mensagem de erro
        driver.save_screenshot(f"erro_whatsapp_{contact_name}_{time.time()}.png") # Salva uma captura de tela para depuração

def main(): # Define a função principal do script
    script_dir = os.path.dirname(os.path.abspath(__file__)) # Obtém o diretório do script atual
    profile_dir = os.path.join(script_dir, "chrome_profile_whatsapp") # Define o caminho completo para o diretório de perfil do Chrome

    if not os.path.exists(profile_dir): # Verifica se o diretório de perfil não existe
        os.makedirs(profile_dir) # Cria o diretório de perfil se ele não existir
        print(f"Diretório de perfil criado: {profile_dir}") # Imprime mensagem de status
    else: # Se o diretório de perfil já existe
        print(f"Usando diretório de perfil existente: {profile_dir}") # Imprime mensagem de status

    driver = None # Inicializa a variável driver como None
    try: # Inicia um bloco try-except para lidar com erros gerais no script
        driver = setup_driver(profile_dir) # Chama a função setup_driver para configurar e obter o objeto driver
        open_whatsapp_web(driver) # Chama a função open_whatsapp_web para abrir e logar no WhatsApp Web

        # --- EXEMPLOS DE USO DA FUNÇÃO DE ENVIO DE MENSAGEM ---
        # ATENÇÃO: Substitua 'Nome do Contato ou Grupo' pelo nome EXATO do contato ou grupo no seu WhatsApp.
        # Se for um número, certifique-se de que ele está salvo com um nome no seu WhatsApp.
        send_whatsapp_message(driver, "Meu Claro", "Olá, esta é uma mensagem de teste enviada via automação Python!") # Chama a função para enviar uma mensagem
        time.sleep(5) # Espere um pouco antes de tentar a próxima mensagem (se houver)

        # send_whatsapp_message(driver, "Outro Contato", "Esta é a segunda mensagem de teste.") # Exemplo de envio para outro contato (comentado)
        # time.sleep(5) # Pausa (comentado)

        print("\nAutomação de envio de mensagens concluída.") # Imprime mensagem de finalização
        print("Pressione Enter no terminal para fechar o navegador e finalizar o script...") # Imprime instrução para o usuário
        input() # Aguarda a entrada do usuário para manter o navegador aberto

    except Exception as e: # Captura qualquer exceção que ocorra no bloco try principal
        print(f"Ocorreu um erro geral no script: {e}") # Imprime mensagem de erro geral
    finally: # Bloco finally é sempre executado, independentemente de ocorrer um erro ou não
        if driver: # Verifica se o objeto driver foi criado com sucesso (não é None)
            print("Fechando o navegador...") # Imprime mensagem de status
            driver.quit() # Fecha o navegador controlado pelo Selenium
            print("Navegador fechado.") # Imprime mensagem de status

if __name__ == "__main__": # Verifica se o script está sendo executado diretamente (não importado como módulo)
    main() # Chama a função principal para iniciar a execução do script