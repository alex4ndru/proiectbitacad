<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Petitions;
use App\Citizens;
use App\Votes;
use App\Citizensvotes;
use Auth;
use App\User;

class Page extends Controller
{
    protected $userName, $logIn, $logOut;
    
    public function __construct()
    {
        $this->middleware( 'auth', ['only' => ['servePetitiiNew'] ] );
        
        $this->userName = 'Guest';
        $this->logOut = '';
        $this->logIn = ""
                . "<div><a href='/auth/register'>Register</a></div>"
                . "<div><a href='/auth/login'>Login</a></div>";
        if( Auth::user() )
        {
            $this->userName = Auth::user()->name;
            $this->logIn = '';
            $this->logOut = "<div><a href='/auth/logout'>Logout</a></div>";
        }
    }
    
    public function serveHome()
    {
        return view('pages.home')->with(['userName' => $this->userName, 'logIn' => $this->logIn, 'logOut' => $this->logOut]);
    }
    
    public function serveInfo()
    {
        return view('pages.info')->with(['userName' => $this->userName, 'logIn' => $this->logIn, 'logOut' => $this->logOut]);;
    }
    
    protected function addCountedVotes($petitions)
    {
        $i = 0;
        foreach($petitions as $currentPetition)
        {
            $where = ['petitionId' => $currentPetition['id'], 'voteYes' => 1];
            $votesYes = count(Votes::where($where)->get()->toArray());
            
            $where = ['petitionId' => $currentPetition['id'], 'voteNo' => 1];
            $votesNo = count(Votes::where($where)->get()->toArray());
            
            $petitions[$i]['votesYes'] = $votesYes;
            $petitions[$i]['votesNo'] = $votesNo;
            $i++;
        }
        
        return $petitions;
    }
    
    public function servePetitii()
    {
        //$results = Petitions::all()->toArray();
        $petitions = Petitions::orderBy('created_at','DESC')->get()->toArray();
        //dd($petitions);
        
        /*
        $i = 0;
        foreach($petitions as $currentPetition)
        {
            $where = ['petitionId' => $currentPetition['id'], 'voteYes' => 1];
            $votesYes = count(Votes::where($where)->get()->toArray());
            
            $where = ['petitionId' => $currentPetition['id'], 'voteNo' => 1];
            $votesNo = count(Votes::where($where)->get()->toArray());
            
            $petitions[$i]['votesYes'] = $votesYes;
            $petitions[$i]['votesNo'] = $votesNo;
            $i++;
        }
        */
        
        $petitions = $this->addCountedVotes($petitions);
        return view('pages.petitii')->with(['petitions' => $petitions, 'userName' => $this->userName, 'logIn' => $this->logIn, 'logOut' => $this->logOut]);
    }
    
    public function servePetitiiDetails($id)
    {
        $petition = Petitions::where('id',$id)->first()->toArray();
        
        //$citizenNickName = Citizens::where('id',$petition['authorId'])->first()->toArray()['nickname'];
        //$petition['author'] = $citizenNickName;
        
        $petition['author'] = User::find($petition['authorId'])->toArray()['name'];
        
        $petition = $this->addCountedVotes([$petition])[0]; //pentru ca metoda asteapta array si intoarce array ... merge dar arata cam ciudat
        
        if($this->userName == "Guest")
        {
            return view('pages.detailspetitionguest')->with(['petition' => $petition, 'userName' => $this->userName, 'logIn' => $this->logIn, 'logOut' => $this->logOut]);
        }
        else
        {
            return view('pages.detailspetition')->with(['petition' => $petition, 'userName' => $this->userName, 'logIn' => $this->logIn, 'logOut' => $this->logOut]);
        }
    }
        
    public function servePetitiiNew()
    {
        return view('pages.petitiinew')->with(['userName' => $this->userName, 'logIn' => $this->logIn, 'logOut' => $this->logOut]);
    }
    public function servePetitiiNewSave()
    {
        $data = Request::all();
        
        $citizen = Auth::user()->toArray();
            
        $row = new Petitions();
        $row->authorId = $citizen['id'];
        $row->title = $data['title'];
        $row->summary = $data['summary'];
        $row->description = $data['description'];
        $row->save();

        return redirect('petitii')->with(['userName' => $this->userName, 'logIn' => $this->logIn, 'logOut' => $this->logOut]);
    }
    
    public function servePetitiiVoteFor($id)
    {
        $data = Request::all();
        
        $citizen = Auth::user()->toArray();
        
        $where = ['citizenId' => $citizen['id'], 'petitionId' => $id];
        $votedBefore = Citizensvotes::where($where)->get()->first();

        if($votedBefore === null) //nu a mai votat pe aceasta petitie
        {
            //inregistrare vot in lista
            $row = new Votes();
            $row->petitionId = $id;
            $row->voteYes = 1;
            $row->save();

            //marcare citizen ca a votat pe aceasta petitie
            $row = new Citizensvotes();
            $row->citizenId = $citizen['id'];
            $row->petitionId = $id;
            $row->save();

            return redirect('petitii')->with(['userName' => $this->userName, 'logIn' => $this->logIn, 'logOut' => $this->logOut]);
        }
        else
        {
            echo "can't vote again !";
        }
    }
    
    public function servePetitiiVoteAgainst($id)
    {
        $data = Request::all();        
        
        $citizen = Auth::user()->toArray();
        
        $where = ['citizenId' => $citizen['id'], 'petitionId' => $id];
        $votedBefore = Citizensvotes::where($where)->get()->first();

        if($votedBefore === null) //nu a mai votat pe aceasta petitie
        {
            //inregistrare vot in lista
            $row = new Votes();
            $row->petitionId = $id;
            $row->voteNo = 1;
            $row->save();

            //marcare citizen ca a votat pe aceasta petitie
            $row = new Citizensvotes();
            $row->citizenId = $citizen['id'];
            $row->petitionId = $id;
            $row->save();

            return redirect('petitii')->with(['userName' => $this->userName, 'logIn' => $this->logIn, 'logOut' => $this->logOut]);
        }
        else
        {
            echo "can't vote again !";
        }
    }
    
    public function serveTaxe()
    {
        return view('pages.taxe')->with(['userName' => $this->userName, 'logIn' => $this->logIn, 'logOut' => $this->logOut]);
    }
    
    public function serveAlegeri()
    {
        return view('pages.alegeri')->with(['userName' => $this->userName, 'logIn' => $this->logIn, 'logOut' => $this->logOut]);
    }
    
    public function serveContact()
    {
        return view('pages.taxe')->with(['userName' => $this->userName, 'logIn' => $this->logIn, 'logOut' => $this->logOut]);
    }
    
    public function serveHelp()
    {
        return view('pages.alegeri')->with(['userName' => $this->userName, 'logIn' => $this->logIn, 'logOut' => $this->logOut]);
    }
    
    public function serveCity()
    {
        return view('pages.city')->with(['userName' => $this->userName, 'logIn' => $this->logIn, 'logOut' => $this->logOut]);
    }
}
