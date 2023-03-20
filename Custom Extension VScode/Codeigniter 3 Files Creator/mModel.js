var capitalize = require('./functions');

module.exports = function (vscode, fs, path, pathdir) {
    var folderName = '/';
    // vscode.window.showInputBox({
    //     prompt: "Enter name of folder",
    //     placeHolder: "Enter name to create or choose folder leave empty for default"
    // }).then(function (folderName) {
    //     if (folderName.length == 0) {
    //         vscode.window.showInformationMessage("Models main folder selected.")+folderName;
    //     }
        vscode.window.showInputBox({
            prompt: "Enter name of model",
            placeHolder: "Enter model name"
        }).then(function (val) {
            if (val.length == 0) {
                vscode.window.showErrorMessage("Model file name required.");
            } else {
                var modelDir = `${pathdir}/application/models/${folderName}`;
                var pathfile = `${path.join(modelDir, "M_"+val.toLowerCase())}.php`;
                fs.access(pathfile, function (err) {
                    if (!err) {
                        vscode.window.showWarningMessage("Model file name already exists!");
                    } else {
                        if (!fs.existsSync(modelDir)) {
                            try {
                                fs.mkdirSync(modelDir, {
                                    recursive: true
                                });
                            } catch (err) {
                                console.log(err);
                            }
                            vscode.window.showInformationMessage(`${folderName} folder created in models.`);
                        }
                        fs.open(pathfile, "w+", function (err, fd) {
                            if (err) throw err;
                            fs.writeFileSync(fd, `<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class M_${val.toLowerCase()} extends CI_Model 
{
    public $table = 'tbl_${val.toLowerCase()}';
    public $id = 'id_${val.toLowerCase()}';

	public function insert($data)
	{
		$this->db->insert($this->table, $data);
	}

	public function get_all()
	{
		$this->db->order_by($this->id, 'desc');
		return $this->db->get($this->table);
	}

	public function get_by_id($id)
	{
		$this->db->where($this->id, $id);
		return $this->db->get($this->table);
	}

	public function update($data,$id)
	{
		$this->db->where($this->id, $id);
		$this->db->update($this->table, $data);
	}

	public function delete($id)
	{
		$this->db->where($this->id, $id);
		$this->db->delete($this->table);
	}                                          
}


/* End of file M_${val.toLowerCase()}.php and path ${pathfile.replace(pathdir,'')} */
`);
                            fs.close(fd);
                            var openPath = vscode.Uri.file(pathfile); //A request file path
                            vscode.workspace.openTextDocument(openPath).then(function (val) {
                                vscode.window.showTextDocument(val);
                            });
                        });
                        vscode.window.showInformationMessage('Model created successfully!');
                    }
                });
            }
        });
    // });
}