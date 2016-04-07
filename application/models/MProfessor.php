<?php
Class MProfessor extends CI_Model
{

  public function insert_professor($professor)
  {
    $professor['senha']=md5($professor['senha']);
    $this->db->insert('tb_professor',$professor);
  }

  public function check_siape()
  {
    $this->db->select('siape');
    $this->db->from('tb_professor');
    $query = $this->db->get();

    return $query->result_array();
  }

  public function check_admin($siape)
  {
    $this->db->select('fk_professor');
    $this->db->from('tb_admin');
    $this->db->where('fk_professor', $siape);
    $query = $this->db->get();

    if ($query->num_rows() == 1)
    {
      return true;
    }
    else
    {
      return false;
    }

  }

  public function login($siape, $senha)
  {
    $senha = MD5($senha);
    $this->db->select('siape');
    $this->db->from('tb_professor');
    $this->db->where('siape', $siape);
    $this->db->where('senha', $senha);

    $query = $this->db->get();

    if ($query->num_rows() == 1)
    {
      return $query->row_array();
    }
    else
    {
      return false;
    }
  }

  public function get($siape)
  {
    $this->db->select('*');
    $this->db->from('view_professor');
    $this->db->where('siape', $siape);

    $query = $this->db->get();

    if ($query->num_rows() == 1)
    {
      return $query->row_array();
    }
    else{
      return false;
    }
  }

  public function getRaw($siape)
  {
    $this->db->select('*');
    $this->db->from('tb_professor');
    $this->db->where('siape', $siape);

    $query = $this->db->get();

    if ($query->num_rows() == 1)
    {
      return $query->row_array();
    }
    else{
      return false;
    }
  }

  public function updatefield($key, $col, $val)
  {
    $this->db->set($col, $val);
    $this->db->where("siape", $key);
    $this->db->update('tb_professor');
  }
}
?>