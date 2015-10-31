<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Petitions;
use App\Citizens;
use App\Votes;
use App\Citizensvotes;

class Page extends Controller
{
    public function serveHome()
    {
        return view('pages.home');
    }
    
    public function serveInfo()
    {
        return view('pages.info');
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
        
        return view('pages.petitii')->with(['petitions' => $petitions]);
    }
    
    public function servePetitiiDetails($id)
    {
        $petition = Petitions::where('id',$id)->first()->toArray();
        $citizenNickName = Citizens::where('id',$petition['authorId'])->first()->toArray()['nickname'];
        $petition['author'] = $citizenNickName;
        
        $petition = $this->addCountedVotes([$petition])[0]; //pentru ca metoda asteapta array si intoarce array ... merge dar arata cam ciudat
        
        return view('pages.detailspetition')->with(['petition' => $petition]);
    }
        
    public function servePetitiiNew()
    {
        return view('pages.petitiinew');
    }
    public function servePetitiiNewSave()
    {
        //salvare in db si redirect catre lista de petitii
        $data = Request::all();
        
        $nickname=strstr($data['citizenToken'], '-', true);
        $citizen = Citizens::where('nickname',$nickname)->first();//->toArray();
        
        if($citizen !== null) //daca citizen exista in DB
        {
            $citizen = $citizen->toArray();
            
            $row = new Petitions();
            $row->authorId = $citizen['id'];
            $row->title = $data['title'];
            $row->summary = $data['summary'];
            $row->description = $data['description'];
            $row->save();
            
            return redirect('petitii');
        }
        else
        {
            return view('pages.nouser');
        }  
    }
    
    public function servePetitiiVoteFor($id)
    {
        $data = Request::all();
        
        $nickname=strstr($data['citizenToken'], '-', true);
        $citizen = Citizens::where('nickname',$nickname)->first();//->toArray();
        
        if($citizen !== null) //daca citizen exista in DB
        {
            $citizen = $citizen->toArray();
            
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
                
                return redirect('petitii');
            }
            else
            {
                echo "can't vote again !";
            }
        }
        else
        {
            return view('pages.nouser');
        }
    }
    
    public function servePetitiiVoteAgainst($id)
    {
        $data = Request::all();
        
        $nickname=strstr($data['citizenToken'], '-', true);
        $citizen = Citizens::where('nickname',$nickname)->first();//->toArray();
        
        if($citizen !== null) //daca citizen exista in DB
        {
            $citizen = $citizen->toArray();
            
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
                
                return redirect('petitii');
            }
            else
            {
                echo "can't vote again !";
            }
            
            
        }
        else
        {
            return view('pages.nouser');
        }
    }
    
    public function serveTaxe()
    {
        return view('pages.taxe');
    }
    
    public function serveAlegeri()
    {
        return view('pages.alegeri');
    }
    
    public function serveContact()
    {
        return view('pages.taxe');
    }
    
    public function serveHelp()
    {
        return view('pages.alegeri');
    }
    
    public function serveCity()
    {
        return view('pages.city');
    }
}
