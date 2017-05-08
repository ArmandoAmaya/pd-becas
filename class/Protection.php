<?php  

// --------------------------------------------------
final class Protection{

	// --------------------------------------------------

	private $CONFIG = array(
		'PHP_FW_ADMIN_EMAIL' => 'armandoamaya@ocrend.com',
		'PHP_FW_PUSH_MAIL' => false,
		'PHP_FW_LOG_FILE' => '__ALERT__',
		'PHP_FW_PROTECTION_UNSET_GLOBALS' => true,
		'PHP_FW_PROTECTION_RANGE_IP_DENY' => true,
		'PHP_FW_PROTECTION_RANGE_IP_SPAM' => true,
		'PHP_FW_PROTECTION_URL' => true,
		'PHP_FW_PROTECTION_REQUEST_SERVER' => true,
		'PHP_FW_PROTECTION_BOTS' => true,
		'PHP_FW_PROTECTION_REQUEST_METHOD' => true,
		'PHP_FW_PROTECTION_DOS' => true,
		'PHP_FW_PROTECTION_UNION_SQL' => true,
		'PHP_FW_PROTECTION_CLICK_ATTACK' => true,
		'PHP_FW_PROTECTION_XSS_ATTACK' => true,
		'PHP_FW_PROTECTION_COOKIES' => true,
		'PHP_FW_PROTECTION_COOKIES_LOGS' => true,
		'PHP_FW_PROTECTION_POST' => true,
		'PHP_FW_PROTECTION_POST_LOGS' => true,
		'PHP_FW_PROTECTION_GET' => true,
		'PHP_FW_PROTECTION_GET_LOGS' => true,
		'PHP_FW_PROTECTION_SERVER_OVH' => true,
		'PHP_FW_PROTECTION_SERVER_KIMSUFI' => true,
		'PHP_FW_PROTECTION_SERVER_DEDIBOX' => true,
		'PHP_FW_PROTECTION_SERVER_DIGICUBE' => true,
		'PHP_FW_PROTECTION_SERVER_OVH_BY_IP' => true,
		'PHP_FW_PROTECTION_SERVER_KIMSUFI_BY_IP' => true,
		'PHP_FW_PROTECTION_SERVER_DEDIBOX_BY_IP' => true,
		'PHP_FW_PROTECTION_SERVER_DIGICUBE_BY_IP' => true,
		'PHP_FW_PROTECTION_STRICT' => true,
		'PHP_ALERT' => true
	);

	// --------------------------------------------------

	private $OVH_SERVER_IP = ['87.98','91.121','94.23','213.186','213.251'];
	private $DEDIBOX_SERVER_IP = ['88.191'];
	private $DIGICUBE_SERVER_IP = ['95.130'];
	private $RANGE_IP_SPAM = ['24', '186', '189', '190', '200', '201', '202', '209', '212', '213', '217', '222'];
	private $RANGE_IP_DENY = ['0', '1', '2', '5', '10', '14', '23', '27', '31', '36', '37', '39', '42', '46', '49', '50', '100', '101', '102', '103', '104', '105', '106', '107', '114', '172', '176', '177', '179', '181', '185', '192', '223', '224'];

	// --------------------------------------------------

	/**
	 * Elimina las variables globales no permitidas
	 * 
	 * @return void
	 */

	private function fw_unset_globals(){
		if ( ini_get('register_globals') ) {
			$allow = array(
				'_ENV' => 1,
				'_GET' => 1,
				'_POST' => 1,
				'_REQUEST' => 1,
				'_COOKIE' => 1,
				'_FILES' => 1,
				'_SERVER' => 1,
				'GLOBALS' => 1
			);

			foreach ($GLOBALS as $k => $v) {
				if(!isset($allow[$k])) unset($k);
			}
		}
	}

	// --------------------------------------------------

	/**
	 * Sana las variables globales, retira todo HTML y PHP de ellas
	 * 
	 * @return string $var - Índice de la variable global
	 * 
	 * @return Devuelve $var sanada
	 */

	private function fw_get_env($var){
		if(isset($_SERVER[$var])) {
	      	return strip_tags($_SERVER[$var]);
	    } else if(isset($_ENV[$var])) {
	      	return strip_tags($_ENV[$var]);
	    } else if(getenv($var)) {
	      	return strip_tags(getenv($var));
	    } else if(function_exists('apache_getenv') and apache_getenv($var, true)) {
	      	return strip_tags(apache_getenv($var, true));
	    }
	}

	// --------------------------------------------------

	/**
	 * Obtiene dirección de la página que emplea el agente de usuario para la pagina actual
	 * 
	 */

	private function fw_get_referer(){
		if ($this->fw_get_env('HTTP_REFERER')) {
			return $this->fw_get_env('HTTP_REFERER');
		}
		return 'No referer';
	}

	// --------------------------------------------------

	/**
	 * Obtiene una ip
	 * 
	 * @return Una ip
	 */

	private function fw_get_ip(){
		if ($this->fw_get_env('HTTP_X_FORWARDED_FOR')) {
			return $this->fw_get_env('HTTP_X_FORWARDED_FOR');
		}else if($this->fw_get_env('HTTP_CLIENT_IP')){
			return $this->fw_get_env('HTTP_CLIENT_IP');
		}

		return $this->fw_get_env('REMOTE_ADDR');
	}

	// --------------------------------------------------

	/**
	 * Obtiene el agente de usuario
	 * 
	 * @return El agente del usuario (chrome, firefox,etc)
	 */

	private function fw_get_user_agent(){
		if ($this->fw_get_env('HTTP_USER_AGENT')){
			return $this->fw_get_env('HTTP_USER_AGENT');
		}
		return '-';
	}

	// --------------------------------------------------

	/**
	 * Obtiene la consulta de la petición de la página
	 * 
	 * @return La petición de la consulta de la página
	 */

	private function fw_get_query_string(){
		if ($this->CONFIG['PHP_FW_PROTECTION_STRICT']) {
			return str_replace('%09', '%20', $_SERVER['REQUEST_URI']);
		}else{
			if ($this->fw_get_env('QUERY_STRING')) {
				return str_replace('%09', '%20', $this->fw_get_env('QUERY_STRING'));
			}

			return '';
		}
	}

	// --------------------------------------------------

	/**
	 * Devuelve el método de la petición
	 * 
	 * @return Devuelve el método de la petición actual [GET, POST, HEAD, PUT]
	 */

	private function fw_get_request_method(){
		if ($this->fw_get_env('REQUEST_METHOD')) {
			return $this->fw_get_env('REQUEST_METHOD');
		}
		return 'Sin Método';
	}

	// --------------------------------------------------

	/**
	 * Obtiene el host de internet
	 * 
	 * @return devuelve el host de internet segun la ip
	 */

	private function fw_gethostbyaddr(){
		if ($this->CONFIG['PHP_FW_PROTECTION_SERVER_OVH'] || $this->CONFIG['PHP_FW_PROTECTION_SERVER_DEDIBOX'] || $this->CONFIG['PHP_FW_PROTECTION_SERVER_KIMSUFI'] || $this->CONFIG['PHP_FW_PROTECTION_SERVER_DIGICUBE']) {
			if (!isset($_SESSION['fw_gethostbyaddr']) || empty($_SESSION['fw_gethostbyaddr'])) {
				$_SESSION['fw_gethostbyaddr'] = gethostbyaddr($this->fw_get_ip());
			}

			return strip_tags($_SESSION['fw_gethostbyaddr']);
		}
		return '';
	}

	// --------------------------------------------------

	/**
	 * Envia un email con una alerta al correo del administrador
	 * 
	 * @param string $subject - Asunto del mensaje
	 * @param string $msj - Mensaje
	 * 
	 * @return void
	 */

	private function fw_push_email($subject, $msg){
		$headers = "From: ProgramingCode Firewall: ". $this->CONFIG['PHP_FW_ADMIN_EMAIL'] ." <".$this->CONFIG['PHP_FW_ADMIN_EMAIL'].">\r\n"
			."Reply-To: ".$this->CONFIG['PHP_FW_ADMIN_EMAIL']."\r\n"
			."Priority: urgent\r\n"
			."Importance: High\r\n"
			."Precedence: special-delivery\r\n"
			."Organization: ProgramingCode\r\n"
			."MIME-Version: 1.0\r\n"
			."Content-Type: text/plain\r\n"
			."Content-Transfer-Encoding: 8bit\r\n"
			."X-Priority: 1\r\n"
			."X-MSMail-Priority: High\r\n"
			."X-Mailer: PHP/" . phpversion() ."\r\n"
			."X-Firewall: 1.0 by ProgramingCode\r\n"
			."Date:" . date("D, d M Y H:s:i") . " +0100\n";

		if ($this->CONFIG['PHP_FW_ADMIN_EMAIL'] != '') {
			mail($this->CONFIG['PHP_FW_ADMIN_EMAIL'], $subject, $msj, $headers);
		}
	}

	// --------------------------------------------------

	/**
	 * Crea un log con la información del atacante
	 * 
	 * @param string $type - Tipo de ataque
	 * @param sting $ip - Ip del atacante
	 * @param string $agent - Agente del atacante
	 * @param string $referer - Referer del atacante
	 * 
	 * @return void
	 */

	private function fw_logs($type, $ip, $agent, $referer){
		$f = fopen('./'.$this->CONFIG['PHP_FW_LOG_FILE'] .'.log', 'a');
		$msj = date('j-m-Y H:i:s') . ' | ' . $type . ' | IP: '. $ip .' | DNS: '.gethostbyaddr($ip) . ' | Agent: '.$agent . PHP_EOL . ' | Referer: '.$referer;

		fwrite($f, $msj);
		fclose($f);
		if ($this->CONFIG['PHP_FW_PUSH_MAIL']) {
			$this->fw_push_email('Alert Firewall '.strip_tags($_SERVER['SERVER_NAME']), 'Firewall logs of '.strip_tags($_SERVER['SERVER_NAME']) ."\n".str_replace('|', "\n", $msj));
		}

	}

	// --------------------------------------------------


	const FW_PROTECTION_DEDIBOX = 'Protection DEDIBOX Server active, this IP range is not allowed !';
	const FW_PROTECTION_DEDIBOX_IP = 'Protection DEDIBOX Server active, this IP is not allowed !';
	const FW_PROTECTION_DIGICUBE = 'Protection DIGICUBE Server active, this IP range is not allowed !';
	const FW_PROTECTION_DIGICUBE_IP = 'Protection DIGICUBE Server active, this IP is not allowed !';
	const FW_PROTECTION_KIMSUFI = 'Protection KIMSUFI Server active, this IP range is not allowed !';
	const FW_PROTECTION_OVH = 'Protection OVH Server active, this IP range is not allowed !';
	const FW_PROTECTION_BOTS = 'Bot attack detected ! stop it ...';
	const FW_PROTECTION_CLICK = 'Click attack detected ! stop it .....';
	const FW_PROTECTION_DOS = 'Invalid user agent ! Stop it ...';
	const FW_PROTECTION_OTHER_SERVER = 'Posting from another server not allowed !';
	const FW_PROTECTION_REQUEST = 'Invalid request method check ! Stop it ...';
	const FW_PROTECTION_SANTY = 'Attack Santy detected ! Stop it ...';
	const FW_PROTECTION_SPAM = 'Protection SPAM IPs active, this IP range is not allowed !';
	const FW_PROTECTION_SPAM_IP = 'Protection died IPs active, this IP range is not allowed !';
	const FW_PROTECTION_UNION = 'Union attack detected ! stop it ......';
	const FW_PROTECTION_URL = 'Protection url active, string not allowed !';
	const FW_PROTECTION_XSS = 'XSS attack detected ! stop it ...';

	// --------------------------------------------------

	private $CT_RULES = Array('applet', 'base', 'bgsound', 'blink', 'embed', 'expression', 'frame', 'javascript', 'layer', 'link', 'meta', 'object', 'onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload', 'script', 'style', 'title', 'vbscript', 'xml');

	public function __construct(){
		
		
		// --------------------------------------------------

		$QUERY_STRING = $this->fw_get_query_string();
		$IP = $this->fw_get_ip();
		$AGENT = $this->fw_get_user_agent();
		$REFERER = $this->fw_get_referer();
		$REQUEST_METHOD = $this->fw_get_request_method();
		$HOST = $this->fw_gethostbyaddr();
		$REGEX_UNION = '#\w?\s?union\s\w*?\s?(select|all|distinct|insert|update|drop|delete)#is';

		// --------------------------------------------------

		if ($this->CONFIG['PHP_FW_PROTECTION_SERVER_OVH'] && stristr('ovh', $HOST)) {
			$this->fw_logs('OVH Server list', $IP, $AGENT, $REFERER);
			if ($this->CONFIG['PHP_ALERT']) {
				die(FW_PROTECTION_OVH);
			}
			Str::redir();
		}

		// --------------------------------------------------

		if ($this->CONFIG['PHP_FW_PROTECTION_SERVER_OVH_BY_IP']) {
			$ip = explode('.', $IP);
			if (sizeof($ip) > 1 && in_array($ip[0] .'.'. $ip[1], $this->OVH_SERVER_IP)) {
				$this->fw_logs('OHV Server Ip', $IP, $AGENT, $REFERER);
				if ($this->CONFIG['PHP_ALERT']) {
					die(FW_PROTECTION_OVH);
				}
				Str::redir();
			}
		}

		// --------------------------------------------------

		if ($this->CONFIG['PHP_FW_PROTECTION_SERVER_KIMSUFI'] && stristr($HOST, 'kimsufi')) {
			$this->fw_logs('KIMSUFI Server list', $IP, $AGENT, $REFERER);
			if ($this->CONFIG['PHP_ALERT']) {
				die(FW_PROTECTION_KIMSUFI);
			}
			Str::redir();
		}

		// --------------------------------------------------

		if ($this->CONFIG['PHP_FW_PROTECTION_SERVER_DEDIBOX'] && stristr($HOST, 'dedibox')) {
			$this->fw_logs('DEDIBOX Server list', $IP, $AGENT, $REFERER);
			if ($this->CONFIG['PHP_ALERT']) {
				die(FW_PROTECTION_DEDIBOX);
			}
			Str::redir();
		}

		// --------------------------------------------------

		if ($this->CONFIG['PHP_FW_PROTECTION_SERVER_DEDIBOX']) {
			$ip = explode('.', $IP);
			if (sizeof($ip) > 1 and $ip[0].'.'.$ip[1] == $this->DEDIBOX_SERVER_IP) {
				$this->fw_logs('DEDIBOX Server Ip', $IP, $AGENT, $REFERER);
				if ($this->CONFIG['PHP_ALERT']) {
					die(FW_PROTECTION_DEDIBOX_IP);
				}
				Str::redir();
			}
		}

		// --------------------------------------------------

		if ($this->CONFIG['PHP_FW_PROTECTION_SERVER_DIGICUBE'] && stristr($HOST,'digicube')) {
			$this->fw_logs('DIGICUBE Server list', $IP, $AGENT, $REFERER);
			if ($this->CONFIG['PHP_ALERT']) {
				die(FW_PROTECTION_DIGICUBE);
			}
			Str::redir();
		}

		// --------------------------------------------------

		if ($this->CONFIG['PHP_FW_PROTECTION_SERVER_DIGICUBE_BY_IP']) {
			$ip = explode('.', $IP);
			if (sizeof($ip) > 1 && $ip[0] . '.' . $ip[1] == $this->DIGICUBE_SERVER_IP) {
				$this->fw_logs('DIGICUBE Server Ip', $IP, $AGENT, $REFERER);
				if ($this->CONFIG['PHP_ALERT']) {
					die(FW_PROTECTION_DIGICUBE_IP);
				}
				Str::redir();
			}
		}

		// --------------------------------------------------

		if ($this->CONFIG['PHP_FW_PROTECTION_RANGE_IP_SPAM']) {
			$ip_r = explode('.', $IP);
			if (in_array($ip_r[0], $this->RANGE_IP_SPAM)) {
				$this->fw_logs('Ip: ('.$ip_r[0].') Spam list', $IP, $AGENT, $REFERER);
				if ($this->CONFIG['PHP_ALERT']) {
					die(FW_PROTECTION_SPAM);
				}
				Str::redir();
			}
		}

		// --------------------------------------------------

		if ($this->CONFIG['PHP_FW_PROTECTION_RANGE_IP_DENY']) {
			$ip_r = explode('.', $IP);
			if (in_array($ip_r, $this->RANGE_IP_DENY)) {
				$this->fw_logs('Ip: ('.$ip_r[0].') reserved list', $IP, $AGENT, $REFERER);
				if ($this->CONFIG['PHP_ALERT']) {
					die(FW_PROTECTION_SPAM_IP);
				}
				Str::redir();
			}
		}

		// --------------------------------------------------

		if ($this->CONFIG['PHP_FW_PROTECTION_COOKIES']) {
			foreach ($_COOKIE as $i => $value) {
				if ($value != str_replace($this->CT_RULES, '*', $value)) {
					if ($this->CONFIG['PHP_FW_PROTECTION_COOKIES_LOGS']) {
						$this->fw_logs('Cookies Protect', $IP, $AGENT, $REFERER);
					}
					$_COOKIE[$i] = htmlentities($value);
				}
			}
		}

		// --------------------------------------------------

		if ($this->CONFIG['PHP_FW_PROTECTION_POST']) {
			foreach ($_POST as $value) {
				if ($value != str_replace($this->CT_RULES, '*', $value)) {
					if ($this->CONFIG['PHP_FW_PROTECTION_POST_LOGS']) {
						$this->fw_logs('POST Protect', $IP, $AGENT, $REFERER);
					}
					unset($value);
				}
			}
		}

		// --------------------------------------------------

		if ($this->CONFIG['PHP_FW_PROTECTION_GET']) {
			foreach ($_GET as $i => $value) {
				if ($value != str_replace($this->CT_RULES, '*', $value)) {
					if ($this->CONFIG['PHP_FW_PROTECTION_GET_LOGS']) {
						$this->fw_logs('GET Protect', $IP, $AGENT, $REFERER);
					}
					$_GET[$i] = htmlentities($value);
				}
			}
		}

		// --------------------------------------------------

		if ($this->CONFIG['PHP_FW_PROTECTION_URL']) {
			$ct_rules = ['absolute_path', 'ad_click', 'alert(', 'alert%20', ' and ', 'basepath', 'bash_history', '.bash_history',
			'cgi-', 'chmod(', 'chmod%20', '%20chmod', 'chmod=', 'chown%20', 'chgrp%20',
			'chown(', '/chown', 'chgrp(', 'chr(', 'chr=', 'chr%20', '%20chr', 'chunked',
			'cookie=', 'cmd', 'cmd=', '%20cmd', 'cmd%20', '.conf', 'configdir', 'config.php',
			'cp%20', '%20cp', 'cp(', 'diff%20', 'dat?', 'db_mysql.inc', 'document.location',
			'document.cookie', 'drop%20', 'echr(', '%20echr', 'echr%20', 'echr=',
			'}else{', '.eml', 'esystem(', 'esystem%20', '.exe',  'exploit', 'file\://',
			'fopen', 'fwrite', '~ftp', 'ftp:', 'ftp.exe', 'getenv', '%20getenv', 'getenv%20',
			'getenv(', 'grep%20', '_global', 'global_', 'global[', 'http:', '_globals',
			'globals_', 'globals[', 'grep(', 'g\+\+', 'halt%20', '.history', '?hl=',
			'.htpasswd', 'http_', 'http-equiv', 'http/1.', 'http_php', 'http_user_agent',
			'http_host', '&icq', 'if{', 'if%20{', 'img src', 'img%20src', '.inc.php', '.inc',
			'insert%20into', 'ISO-8859-1', 'ISO-', 'javascript\://', '.jsp', '.js', 'kill%20',
			'kill(', 'killall', '%20like', 'like%20', 'locate%20', 'locate(', 'lsof%20', 'mdir%20',
			'%20mdir', 'mdir(', 'mcd%20', 'motd%20', 'mrd%20', 'rm%20', '%20mcd', '%20mrd',
			'mcd(', 'mrd(', 'mcd=', 'mod_gzip_status', 'modules/', 'mrd=', 'mv%20', 'nc.exe',
			'new_password', 'nigga(', '%20nigga', 'nigga%20', '~nobody', 'org.apache',
			'+outfile+', '%20outfile%20', '*/outfile/*',' outfile ','outfile',
			'password=', 'passwd%20', '%20passwd', 'passwd(', 'phpadmin',
			'perl%20', '/perl','p0hh',
			'ping%20', '.pl', 'powerdown%20', 'rm(', '%20rm', 'rmdir%20',
			'mv(', 'rmdir(', 'phpinfo()', '<?php', 'reboot%20', '/robot.txt' ,
			'~root', 'root_path', 'rush=', '%20and%20', '%20xorg%20', '%20rush',
			'rush%20', 'secure_site, ok', 'select%20', 'select from', 'select%20from',
			'_server', 'server_', 'server[', 'server-info', 'server-status', 'servlet',
			'sql=', '<script', '<script>', '</script','script>','/script', 'switch{',
			'switch%20{', '.system', 'system(', 'telnet%20', 'traceroute%20', '.txt',
			'union%20', '%20union', 'union(', 'union=', 'vi(', 'vi%20', 'wget', 'wget%20',
			'%20wget', 'wget(', 'window.open', 'wwwacl', ' xor ', 'xp_enumdsn',
			'xp_availablemedia', 'xp_filelist', 'xp_cmdshell', '$_request', '$_get',
			'$request', '$get',  '&aim', '/etc/password','/etc/shadow',
			'/etc/groups', '/etc/gshadow', '/bin/ps', 'uname\x20-a',
			'/usr/bin/id', '/bin/echo', '/bin/kill',
			'/bin/', '/chgrp', '/usr/bin', 'bin/python',
			'bin/tclsh', 'bin/nasm', '/usr/x11r6/bin/xterm',
			'/bin/mail', '/etc/passwd', '/home/ftp', '/home/www', '/servlet/con', '?>', '.txt'];

			$check = str_replace($ct_rules, '*', $QUERY_STRING);
			if ($QUERY_STRING != $check) {
				$this->fw_logs('URL Protection', $IP, $AGENT, $REFERER);
				if ($this->CONFIG['PHP_ALERT']) {
					die(self::FW_PROTECTION_URL);
				}
				Str::redir();
			}
		}

		// --------------------------------------------------

		if ($this->CONFIG['PHP_FW_PROTECTION_REQUEST_SERVER'] && $this->CONFIG['PHP_FW_PROTECTION_REQUEST_METHOD'] == 'POST' && isset($_SERVER['HTTP_REFERER']) && !stristr($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST'], 0)) {

			$this->fw_logs('Posting another server', $IP, $AGENT, $REFERER);
			if ($this->CONFIG['PHP_ALERT']) {
				die(self::FW_PROTECTION_OTHER_SERVER);
			}
			Str::redir();

		}

		// --------------------------------------------------

		if ($this->CONFIG['PHP_FW_PROTECTION_BOTS']) {
			$ct_rules = ['@nonymouse', 'addresses.com', 'ideography.co.uk', 'adsarobot', 'ah-ha',
		      'aktuelles', 'alexibot', 'almaden', 'amzn_assoc', 'anarchie', 'art-online',
		      'aspseek', 'assort', 'asterias', 'attach', 'atomz', 'atspider', 'autoemailspider',
		      'backweb', 'backdoorbot', 'bandit', 'batchftp', 'bdfetch', 'big.brother',
		      'black.hole', 'blackwidow', 'blowfish', 'bmclient', 'boston project', 'botalot',
		      'bravobrian', 'buddy', 'bullseye', 'bumblebee ', 'builtbottough', 'bunnyslippers',
		      'capture', 'cegbfeieh', 'cherrypicker', 'cheesebot', 'chinaclaw', 'cicc', 'civa', 'clipping',
		      'collage', 'collector', 'copyrightcheck', 'cosmos', 'crescent', 'custo', 'cyberalert', 'deweb',
		      'diagem', 'digger', 'digimarc', 'diibot', 'directupdate', 'disco', 'dittospyder', 'download accelerator',
		      'download demon', 'download wonder', 'downloader', 'drip', 'dsurf', 'dts agent', 'dts.agent', 'easydl',
		      'ecatch', 'echo extense', 'efp@gmx.net', 'eirgrabber', 'elitesys', 'emailsiphon', 'emailwolf', 'envidiosos',
		      'erocrawler', 'esirover', 'express webpictures', 'extrac', 'eyenetie', 'fastlwspider', 'favorg', 'favorites sweeper',
		      'fezhead', 'filehound', 'filepack.superbr.org', 'flashget', 'flickbot', 'fluffy', 'frontpage', 'foobot',
		      'galaxyBot', 'generic', 'getbot ', 'getleft', 'getright', 'getsmart', 'geturl', 'getweb', 'gigabaz', 'girafabot',
		      'go-ahead-got-it', 'go!zilla', 'gornker', 'grabber', 'grabnet', 'grafula', 'green research', 'harvest',
		      'havindex', 'hhjhj@yahoo', 'hloader', 'hmview', 'homepagesearch', 'htmlparser', 'hulud', 'http agent',
		      'httpconnect', 'httpdown', 'http generic', 'httplib', 'httrack', 'humanlinks', 'ia_archiver', 'iaea', 'ibm_planetwide',
		      'image stripper', 'image sucker', 'imagefetch', 'incywincy', 'indy', 'infonavirobot', 'informant', 'interget',
		      'internet explore', 'infospiders',  'internet ninja', 'internetlinkagent', 'interneteseer.com', 'ipiumbot',
		      'iria', 'irvine', 'jbh', 'jeeves', 'jennybot', 'jetcar', 'joc web spider', 'jpeg hunt', 'justview', 'kapere',
		      'kdd explorer', 'kenjin.spider', 'keyword.density', 'kwebget', 'lachesis', 'larbin',  'laurion(dot)com', 'leechftp',
		      'lexibot', 'lftp', 'libweb', 'links aromatized', 'linkscan', 'link*sleuth', 'linkwalker', 'libwww', 'lightningdownload',
		      'likse', 'lwp','mac finder', 'mag-net', 'magnet', 'marcopolo', 'mass', 'mata.hari', 'mcspider', 'memoweb',
		      'microsoft url control', 'microsoft.url', 'midown', 'miixpc', 'minibot', 'mirror', 'missigua', 'mister.pix',
		      'mmmtocrawl', 'moget', 'mozilla/2', 'mozilla/3.mozilla/2.01', 'mozilla.*newt', 'multithreaddb', 'munky', 'msproxy',
		      'nationaldirectory', 'naverrobot', 'navroad', 'nearsite', 'netants', 'netcarta', 'netcraft', 'netfactual', 'netmechanic',
		      'netprospector', 'netresearchserver', 'netspider', 'net vampire', 'newt', 'netzip', 'nicerspro', 'npbot', 'octopus',
		      'offline.explorer', 'offline explorer', 'offline navigator', 'opaL', 'openfind', 'opentextsitecrawler', 'orangebot',
		      'packrat', 'papa foto', 'pagegrabber', 'pavuk', 'pbwf', 'pcbrowser', 'personapilot', 'pingalink', 'pockey',
		      'program shareware', 'propowerbot/2.14', 'prowebwalker', 'proxy', 'psbot', 'psurf', 'puf', 'pushsite', 'pump', 'qrva',
		      'quepasacreep', 'queryn.metasearch', 'realdownload', 'reaper', 'recorder', 'reget', 'replacer', 'repomonkey', 'rma',
		      'robozilla', 'rover', 'rpt-httpclient', 'rsync', 'rush=', 'searchexpress', 'searchhippo', 'searchterms.it',
		      'second street research', 'seeker', 'shai', 'sitecheck', 'sitemapper', 'sitesnagger', 'slysearch', 'smartdownload',
		      'snagger', 'spacebison', 'spankbot', 'spanner', 'spegla', 'spiderbot', 'spiderengine', 'sqworm', 'ssearcher100',
		      'star downloader', 'stripper', 'sucker', 'superbot', 'surfwalker', 'superhttp', 'surfbot', 'surveybot', 'suzuran',
		      'sweeper', 'szukacz/1.4', 'tarspider', 'takeout', 'teleport', 'telesoft', 'templeton', 'the.intraformant', 'thenomad',
		      'tighttwatbot', 'titan', 'tocrawl/urldispatcher','toolpak', 'traffixer', 'true_robot', 'turingos', 'turnitinbot',
		      'tv33_mercator', 'uiowacrawler', 'urldispatcherlll', 'url_spider_pro', 'urly.warning ', 'utilmind', 'vacuum', 'vagabondo',
		      'vayala', 'vci', 'visualcoders', 'visibilitygap', 'vobsub', 'voideye', 'vspider', 'w3mir', 'webauto', 'webbandit',
		      'web.by.mail', 'webcapture', 'webcatcher', 'webclipping', 'webcollage', 'webcopier', 'webcopy', 'webcraft@bea',
		      'web data extractor', 'webdav', 'webdevil', 'webdownloader', 'webdup', 'webenhancer', 'webfetch', 'webgo', 'webhook',
		      'web.image.collector', 'web image collector', 'webinator', 'webleacher', 'webmasters', 'webmasterworldforumbot', 'webminer',
		      'webmirror', 'webmole', 'webreaper', 'websauger', 'websaver', 'website.quester', 'website quester', 'websnake', 'websucker',
		      'web sucker', 'webster', 'webreaper', 'webstripper', 'webvac', 'webwalk', 'webweasel', 'webzip', 'wget', 'widow', 'wisebot',
		      'whizbang', 'whostalking', 'wonder', 'wumpus', 'wweb', 'www-collector-e', 'wwwoffle', 'wysigot', 'xaldon', 'xenu', 'xget',
		      'x-tractor', 'zeus'];

			if (strtolower($AGENT) != str_replace($ct_rules, '*', strtolower($AGENT))) {
				$this->fw_logs('Bots Attack', $IP, $AGENT, $REFERER);
				if ($this->CONFIG['PHP_ALERT']) {
					die(self::FW_PROTECTION_BOTS);
				}
				Str::redir();
			}
		}

		// --------------------------------------------------

		if ($this->CONFIG['PHP_FW_PROTECTION_REQUEST_METHOD'] && !in_array(strtolower($REQUEST_METHOD), ['get','post','head','put','update', 'delete'])) {
			$this->fw_logs('Invalid request', $IP, $AGENT, $REFERER);
			if ($this->CONFIG['PHP_ALERT']) {
				die(self::FW_PROTECTION_REQUEST);
			}
			Str::redir();
		}

		// --------------------------------------------------

		if ($this->CONFIG['PHP_FW_PROTECTION_DOS'] && ($AGENT == '' or $AGENT == '-')) {
			$this->fw_logs('Dos attack', $IP, $AGENT, $REFERER);
			if ($this->CONFIG['PHP_ALERT']) {
				die(self::FW_PROTECTION_DOS);
			}
			Str::redir();
		}

		// --------------------------------------------------

		if ($this->CONFIG['PHP_FW_PROTECTION_UNION_SQL']) {
			$stop = 0;
			$ct_rules = ['*/from/*', '*/insert/*', '+into+', '%20into%20', '*/into/*', ' into ', 'into', '*/limit/*',
		    'not123exists*', '*/radminsuper/*', '*/select/*', '+select+', '%20select%20', ' select ',
		    '+union+', '%20union%20', '*/union/*', ' union ', '*/update/*', '*/where/*'];

		    $check = str_replace($ct_rules, '*', $QUERY_STRING);
		    !$QUERY_STRING != $check ?: $stop++;
		    !preg_match($REGEX_UNION, $QUERY_STRING) ?: $stop++;
		    !preg_match('/([OdWo5NIbpuU4V2iJT0n]{5}) /', rawurldecode($QUERY_STRING)) ?: $stop++;
		    !strstr(rawurldecode($QUERY_STRING ), '*') ?: $stop++;
		    if ($stop > 0) {
		    	$this->fw_logs('Union Attack', $IP, $AGENT, $REFERER);
		    	if ($this->CONFIG['PHP_ALERT']) {
					die(self::FW_PROTECTION_UNION);
				}
				Str::redir();
		    }
		}

		// --------------------------------------------------

		if ($this->CONFIG['PHP_FW_PROTECTION_CLICK_ATTACK'] && $QUERY_STRING != str_replace(['/*', 'c2nyaxb0', '/*'], '*', $QUERY_STRING)) {
			$this->fw_logs('Click attack', $IP, $AGENT, $REFERER);
		    if ($this->CONFIG['PHP_ALERT']) {
				die(self::FW_PROTECTION_CLICK);
			}
			Str::redir();

			
		}

		// --------------------------------------------------

		if ($this->CONFIG['PHP_FW_PROTECTION_XSS_ATTACK']) {
			$ct_rules = ['http\:\/\/', 'https\:\/\/', 'cmd=', '&cmd', 'exec', 'concat', './', '../',
      		'http:', 'h%20ttp:', 'ht%20tp:', 'htt%20p:', 'http%20:', 'https:', 'h%20ttps:',
      		'ht%20tps:', 'htt%20ps:', 'http%20s:', 'https%20:', 'ftp:', 'f%20tp:', 'ft%20p:',
      		'ftp%20:', 'ftps:', 'f%20tps:', 'ft%20ps:', 'ftp%20s:', 'ftps%20:'];

      		if ($QUERY_STRING != str_replace($ct_rules, '*', $QUERY_STRING)) {
      			$this->fw_logs('XSS attack', $IP, $AGENT, $REFERER);
			    if ($this->CONFIG['PHP_ALERT']) {
					die(self::FW_PROTECTION_XSS);
				}
				Str::redir();
      		}
		}

		// --------------------------------------------------

		!$this->CONFIG['PHP_FW_PROTECTION_UNSET_GLOBALS'] ?: $this->fw_unset_globals();

		// --------------------------------------------------

	}
}



?>