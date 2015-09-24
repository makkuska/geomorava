    <?php
      //seznam mailů, na které se zpráva odesílá
      $to = 'info@geomorava.cz, marketa.solanska@gmail.com';
      $from = $_POST['odesilatel_mail'];
      //proměnné naplněné z formuláře
      $formSubject = $_POST['predmet'];
      $formMessage = $_POST['zprava'];
      $formUrl = $_POST['url'];
      
      //hlavicka
        $hlavicka = "From:$from\n";
        $hlavicka .= "Subject:$pr\n";
        $hlavicka .= "MIME-Version: 1.0\n";
        // způsob kódování
        $hlavicka .= "Content-Transfer-Encoding: QUOTED-PRINTABLE\n"; 
        $hlavicka .= "X-Mailer: PHP\n";
        $hlavicka .= "Content-Type: text/plain; charset=UTF-8\n"; // Kódování
  
      // formát zprávy pro info@geomorava.cz 
      $subjectCopy = 'Kopie zprávy z webu www.geomorava.cz';
      $messageCopy = 'Vaše zpráva, kterou jste odeslali přes web www.geomorava.cz:' . "\n" .$formMessage;
      
      //kopie emailu pro odesílatele dotazu
      $subjectOrig = "Dotaz z webu: $formSubject";


      if (!empty($formUrl)) {
          $page1  = '<br /><div class="jumbotron"><div class="container"><p>' .$formUrl .
          $page1 .= '</p><a class="btn btn-default" href="http://www.geomorava.cz">';
          $page1 .= ' Zpět na geomorava.cz</a></p> </div></div>';
          echo ($page1);
      } else if (empty($from) or empty($formMessage) or empty($formSubject)) { 
          $page2 = '<br /><div class="jumbotron"><div class="container">';
          $page2 .= '<p>Omlouváme se, někde nastala chyba. Váš e-mail nebyl odeslán.</p>';
          $page2 .= '<p>Zkuste zadat požadavek znovu, zkontrolujte, že jste vyplnili všechny kolonky.';
          $page2 .= 'V případě, že to stále nepůjde, kontaktujte nás přímo na e-mailu info@geomorava.cz ';
          $page2 .= 'nebo na telefonním čísle +420 725 533 526. Děkujeme za pochopení.</p><p>';
          $page2 .= '<a class="btn btn-default" href="http://www.geomorava.cz">Zpět na geomorava.cz</a></p>';
          $page2 .= '</div></div>';
          echo ($page2);
      } else {
          mail($to,   $subjectOrig, $formMessage, $hlavicka);
          mail($from, $subjectCopy, $messageCopy, $hlavicka);
          $page3 = '<br /><div class="jumbotron"><div class="container">';
          $page3 .= '<p>Váš mail byl úspěšně odeslán. Děkujeme za Vaši zprávu či dotaz.</p>';
          $page3 .= '<p> Po přečtení se budeme snažit, co nejdříve odpovědět na Váš e-mail ('.$from.').</p>';
          $page3 .= '<p><a class="btn btn-default" href="http://www.geomorava.cz">Zpět na geomorava.cz</a></p>';
          $page3 .= '</div></div>';
          echo ($page3);
      }
      ?>
