<?php

use Illuminate\Database\Seeder;
use App\Message;
use App\Apartment;
use App\User;
use Faker\Generator as Faker;

class MessagesTableSeeder extends Seeder
{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run(Faker $faker)
	{
	$messageTemplate = [
		'message' => [
			'Sempre affidabili uso spesso questa piattaforma per alloggi di breve termine, un punto di riferimento quando devo prenotare un alloggio. La uso spesso con il lavoro che svolgo, mai avuto problemi. Servizio assistenza sempre disponibile e pronto',
			'Capisco le vostre procedure , però cerchi di capire anche in che situazione ci siamo trovati noi. Dopo un giorno di viaggio assurdo in quanto rimasti bloccati nelle Filippine, siamo entrati in questo appartamento verso le 23, tutto andava bene: appartamento grande e con cucina (anche se dalle foto non era decisamente quello che avevamo prenotato)..quindi non ci è passato nemmeno per la mente di fare foto o altro..eravamo solo stanchi ed affamati.',
			'La camera che ci propongono è semplicemente la camera di un loro bambino che è stata adibita al momento per noi. Così ci rifiutiamo di rimanere dato che non è nemmeno lontanamente ciò che avevamo prenotato.',
			'Va bene sono cose che capitano, però è inaccettabile a questo punto che il proprietario non ci abbia rimborsato e anzi continui a ignorare i nostri messaggi.',
			'Mi aspetterei da parte vostra un intervento in situazioni del genere per salvaguardare i clienti truffati come noi ed evitarne di futuri!',
			'Ciao, tutto questo lo puoi scrivere nella recensione e quello che mi riporti qui io lo segnalerò ad Boolbnb per ulteriori accertamenti.',
			'Come ti dicevo nel mio primo messaggio, da parte nostra posso solo rimborsarti in forma di coupon le nostre spese di servizio, se sei d\'accordo, anche se si tratta di una cifra non molto alta.',
			'Era la prima volta che mi sono scritta sul sito Boolbnb , e risulta che l aereolinea mi ha cancellato il volo destinazione Roma . Ho dovuto cancellare la prenotazione ',
			'Leggo con molto dispiacere e stupore tutti questi messaggi negativi su Boolbnb e sugli Host. Siete stati davvero sfortunati, nella mia zona, il Chianti Classico mai sentito cose del genere, noi host siamo molto seri e l\'obiettivo principale è fare trovare le case pulite, ordinate, con biancheria fresca e pulita e soprattutto il rapporto con il Cliente che è fondamentale',
			'Perdonate.. non mi sembra normale non possa recensire un host  che è stata pessima fintanto non sia lei a scrivere qualcosa prima su di me.. sfido che le uniche recensioni pubblicate siano positive.. Boolbnb vende il fumo.. mai più!',
			'Tanta roba. Permettono di trovare sempre case in affitto o stanze al prezzo più basso di sempre. Grazie Boolbnb!PS: vi lascio il mio link che vi permette di ottenere ben 25euro di sconto sulla prima prenotazione',
			'Sono anni che soggiorno con la famiglia tramite Boolbnb e continueró a farlo finché gli albergatori non si daranno una calmata con i loro prezzi folli. Siamo in quattro e viaggiare in certe località italiane (Venezia, Firenze....) costa un patrimonio. Non parliamo di Svizzera e dei paesi nordici!Abbiamo sempre trovato hosts gentili, disponibili a risolvere i piccoli problemi e case pulite.',
			'Brutte esperienze con persone che affittano cantine e magazzini come fossero appartamenti in pieno centro a Roma senza finestre!! Puzza di muffa e recensioni a 4.8 stelle (il massimo è 5)..!',
			'Lo staff è fantastico!!!Ho avuto un\'esperienza pessima con un Host. Mi ha confermato la prenotazione, ha incassato la rata, dopo di che mi ha esortata a cercare altrove poiché non aveva in realtà disponibilità per tutto il periodo che avevo prenotato.',
			'Siamo state costrette a prenotare un albergo su booking, con prezzo molto maggiorato rispetto a quello che avevamo pagato e non prevedendo alcun tipo di rimborso, nè dei soldi spesi in più, nè del tempo che abbiamo perso per trovare in autonomia un\'alternativa. Non userò mai più questo sito che non verifica adeguatamente i suoi host e che non è in grado di tutelare i propri clienti.',
			'Mi sono trovato sempre bene, non ho mai avuto nessun problema con le prenotazioni, anzi.Asistenza clienti celere.',
			'Io ho prenotato a gennaio ‘19 un alloggio per Agosto.Tutto è filato liscio come l’olio, nessun intoppo e poi un host eccezionale!Tutto come da foto e massima disponibilità.Grazie all\'host e a Boolbnb',
			'La mia esperiemza e stata piu che positiva anzi eccellente.. avevo prenotato l\' appartamento per il mese di agosto già dato la caparra ma purtroppo è sorto un problema e quindi abbiamo dovuto rimandare fatto disdetta venerdì pomeriggio nel giro di 24 ore avevo già il rimborso sulla mia carta quindi che dire eccellente dir poco tutto come scritto.Ringrazio tantissimo la disponibilità dei proprietari di casa e sono sicur che vi ricontatterò presto!!!',
			'Siamo stati molto bene nella casa fittta- La casa è dotata di spazi molto ampi sia all\'interno che all\'esterno ed è ben attrezzata. La zona è molto tranquilla e ricca di giardini e silenziosa. Molto vicino è un Lido sulla spiaggia, troppo affollato la domenica, ma confortevole gli altri giorni. La posizione permette di visitare agevolmente diversi siti interessanti. Naturalmente è indispensabile avere l\'auto. I proprietari si sono dimostratati sempre accoglienti e disponibili. Li ringraziamo.',
			'Complimenti per la splendida ospitalità in una casa carinissima super pulita. Ci avete accolti facendoci sentire di famiglia...vi ringrazio e sappiate che l\'appartamento lo consiglierò sinceramente a tutti'


		],
	];
		for ($i=0; $i < 20; $i++) {
		$message = new Message;
		$message->apartment_id = Apartment::inRandomOrder()->first()->id;
		$message->message = $messageTemplate['message'][$i];
		$message->email = $faker->email;
		$message->save();
		}
	}
}
